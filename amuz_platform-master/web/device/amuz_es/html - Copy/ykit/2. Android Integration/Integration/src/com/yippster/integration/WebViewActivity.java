
package com.yippster.integration;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.BroadcastReceiver;
import android.content.ContentValues;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.res.Configuration;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

public class WebViewActivity extends Activity {

	private WebView mWebView;
	private String mUrl;
	private static final String TAG = "WebViewActivity";
	private ProgressDialog mDialog;
	private String mSMSNumber;
	private String mMsgBody;
	private boolean mIsDualSIM;
	private boolean mIsSIM2Ready;
	private boolean mIsSIM1Ready;
	private Context mContext = this;

	// Replace the below urls with the production urls.
	private static final  String CHECKOUTURL = "http://abhishek.yipp.in/yippster/index.php";
	private static final  String SURL = "http://abhishek.yipp.in/yippster/receive.php";
	private static final  String CURL = "http://abhishek.yipp.in/yippster/cancel.php";
	private static final  String FURL = "http://abhishek.yipp.in/yippster/fail.php";
	private static final  String ERRORURL = "http://abhishek.yipp.in/yippster/error.php";
	private static final  String ENTURL = "http://yippster.com/smspay/testent.php";

	// This is the title of receive.php page
	private static final String TRANSACTION_SUCCESSFUL_TOKEN = "successful";
	// This is the title of cancel.php page
	private static final String TRANSACTION_CANCELLED_TOKEN = "cancelled";
	// This is the title of fail.php page
	private static final String TRANSACTION_FAILED_TOKEN = "failed";
	private static final String TRIGGER_SMS_TOKEN = "smsto";


	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.webview);		
		Log.i(TAG, "in onCreate, url = " + mUrl);
		mUrl = CHECKOUTURL;
		mDialog = new ProgressDialog(this);
		mWebView = (WebView) findViewById(R.id.webView);
		mWebView.getSettings().setJavaScriptEnabled(true);
		mWebView.loadUrl(mUrl);
		mWebView.setWebViewClient(new MyWebViewClient());

	}

	private class MyWebViewClient extends WebViewClient {
		@Override
		public void onPageStarted(WebView view, String url, Bitmap favicon) {

			if (mDialog != null) {
				mDialog.setMessage("Please wait...");
				mDialog.show();
			}
			super.onPageStarted(view, url, favicon);
		}
		public void onPageFinished(WebView view, String url) {
			Log.i(TAG, "in onPageFinished, url = " + url);
			mUrl = url;
			if (url.contains(SURL) && view.getTitle()!= null) {
				if (view.getTitle().contains(TRANSACTION_SUCCESSFUL_TOKEN)) {
					Intent intent = new Intent(mContext, SuccessActivity.class);
					startActivity(intent);
					finish();
				}
			}
			if (url.contains(CURL) && view.getTitle()!= null) {
				if (view.getTitle().contains(TRANSACTION_CANCELLED_TOKEN)) {
					Intent intent = new Intent(mContext, CancelActivity.class);
					startActivity(intent);
					finish();
				}
			}
			if (url.contains(FURL) && view.getTitle()!= null) {
				if (view.getTitle().contains(TRANSACTION_FAILED_TOKEN)) {
					Intent intent = new Intent(mContext, FailActivity.class);
					startActivity(intent);
					finish();
				}
			}

			if (url.contains(ERRORURL)) {
				Intent intent = new Intent(mContext, ErrorActivity.class);
				startActivity(intent);
				finish();
			}

			if(mDialog  != null && mDialog.isShowing()) mDialog.dismiss();
			super.onPageFinished(view, url);
		}

		public boolean shouldOverrideUrlLoading(WebView view, String url){
			Log.i(TAG, "in shouldOverrideUrlLoading, Url = " + url);
			super.shouldOverrideUrlLoading(view, url);

			if(url.contains(TRIGGER_SMS_TOKEN)) {
				launchSMSConfirmation(url);
			}
			else {
				view.loadUrl(url);
			}
			return true; 
		}
	}
	/*
	 * Launch Alert dialog to send SMS 
	 * if single sim is present on the 
	 * devices else launch the SMS App
	 */

	private void launchSMSConfirmation(String url) {
		String body = url.replace("%20", " ");

		// Get the recipient number.
		Pattern digitPattern = Pattern.compile("\\d{5}");
		Matcher matcher = digitPattern.matcher(url);
		if (matcher.find()) {
			mSMSNumber = matcher.group(0);
		} else {
			Log.i(TAG, "No match for recipient number");
		}

		body = body.replace("smsto:"+ mSMSNumber + "?body=", "");

		mMsgBody = body;

		// Check if the phone is dual SIM

//		if (mIsDualSIM && mIsSIM1Ready && mIsSIM2Ready) {
//			sendSMSBySMSApp(mSMSNumber, mMsgBody);
//		}
//
//		else  {
//			launchAlertDialog();
//		}
		
		sendSMSBySMSApp(mSMSNumber, mMsgBody);
	}

	private void launchAlertDialog() {
		AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
				mContext);

		alertDialogBuilder.setTitle("Send SMS to " + mSMSNumber + "?");
		alertDialogBuilder.setMessage("The SMS will be saved in your sent items.")
		.setCancelable(false)
		.setPositiveButton("No",new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog,int id) {
				dialog.cancel();
			}
		})
		.setNegativeButton("Yes",new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog,int id) {
				sendSMSByApi(mSMSNumber, mMsgBody);
			}
		});

		AlertDialog alertDialog = alertDialogBuilder.create();

		alertDialog.show();
	}

	/*
	 * Send SMS by API, show notifications in Toast .
	 */
	private void sendSMSByApi(String phoneNumber, String message) 	{

		String SENT = "SMS_SENT";
		String DELIVERED = "SMS_DELIVERED";

		PendingIntent sentPI = PendingIntent.getBroadcast(this, 0,
				new Intent(SENT), 0);

		PendingIntent deliveredPI = PendingIntent.getBroadcast(this, 0,
				new Intent(DELIVERED), 0);

		//---when the SMS has been sent---
		registerReceiver(new BroadcastReceiver(){
			@Override
			public void onReceive(Context arg0, Intent arg1) {
				switch (getResultCode())
				{
				case Activity.RESULT_OK:
					sendtoSentItems();
					Toast.makeText(getBaseContext(), "SMS sent", 
							Toast.LENGTH_SHORT).show();
					break;
				case SmsManager.RESULT_ERROR_GENERIC_FAILURE:
					Toast.makeText(getBaseContext(), "Generic failure", 
							Toast.LENGTH_SHORT).show();
					break;
				case SmsManager.RESULT_ERROR_NO_SERVICE:
					Toast.makeText(getBaseContext(), "No service", 
							Toast.LENGTH_SHORT).show();
					break;
				case SmsManager.RESULT_ERROR_NULL_PDU:
					Toast.makeText(getBaseContext(), "Null PDU", 
							Toast.LENGTH_SHORT).show();
					break;
				case SmsManager.RESULT_ERROR_RADIO_OFF:
					Toast.makeText(getBaseContext(), "Radio off", 
							Toast.LENGTH_SHORT).show();
					break;
				}
			}
		}, new IntentFilter(SENT));

		//---when the SMS has been delivered---
		registerReceiver(new BroadcastReceiver(){
			@Override
			public void onReceive(Context arg0, Intent arg1) {
				switch (getResultCode())
				{
				case Activity.RESULT_OK:
					Toast.makeText(getBaseContext(), "SMS delivered", 
							Toast.LENGTH_SHORT).show();
					break;
				case Activity.RESULT_CANCELED:
					Toast.makeText(getBaseContext(), "SMS not delivered", 
							Toast.LENGTH_SHORT).show();
					break;                        
				}
			}
		}, new IntentFilter(DELIVERED));        
		try {
			SmsManager sms = SmsManager.getDefault();
			sms.sendTextMessage(phoneNumber, null, message, sentPI, deliveredPI);
		} catch(Exception e) {
			e.printStackTrace();
		}
	}
	/*
	 * Save to Sent items
	 */
	private void sendtoSentItems() {
		ContentValues values = new ContentValues();
		values.put("address", mSMSNumber);
		values.put("body", mMsgBody);
		mContext.getContentResolver().insert(Uri.parse("content://sms/sent"), values);
	}


	/*
	 * Launch SMS App
	 */

	private void sendSMSBySMSApp(String phoneNumber, String message){

		Intent smsIntent = new Intent(Intent.ACTION_VIEW);
		smsIntent.setType("vnd.android-dir/mms-sms");
		smsIntent.putExtra("address", mSMSNumber);
		smsIntent.putExtra("sms_body",mMsgBody);
		startActivity(smsIntent);			
	}

	/*
	 * Handle Configuration Change
	 */

	@Override
	public void onConfigurationChanged(Configuration newConfig) {
		super.onConfigurationChanged(newConfig);
	}
	/*
	 * Disable back at ENTURL, show Toast notification to use cancel button 
	 */
	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		if ((keyCode == KeyEvent.KEYCODE_BACK && mUrl.contains( ENTURL)) ) {
			Toast.makeText(mContext, "Please press cancel to cancel the transaction", Toast.LENGTH_LONG).show();
			return false;
		}
		return super.onKeyDown(keyCode, event);
	}
}