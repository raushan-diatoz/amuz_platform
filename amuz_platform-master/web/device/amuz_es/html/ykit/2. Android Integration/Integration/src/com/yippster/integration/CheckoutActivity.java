package com.yippster.integration;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;

public class CheckoutActivity extends Activity {
	private Button mButton;


	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.checkout);

		mButton = (Button) findViewById(R.id.btn);

		mButton.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View arg0) {

				if (isNetworkAvailable()) {
					Intent intent = new Intent(getApplicationContext(), WebViewActivity.class);

					startActivity(intent);
				}
				else {
					Toast.makeText(getApplicationContext(), "No internet connectivity", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}

	/*
	 * Check if internet connectivity is present
	 */
	private boolean isNetworkAvailable() {
		ConnectivityManager connectivityManager 
		= (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
		NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
		return activeNetworkInfo != null && activeNetworkInfo.isConnected();
	}
}
