package com.yippster.integration;


import java.lang.reflect.Method;

import android.content.Context;
import android.telephony.TelephonyManager;
import android.util.Log;

public final class TelephonyInfo {

	private static final String TAG = "TelephonyInfo";
	private static TelephonyInfo telephonyInfo;
	private String mImeiSIM1;
	private String mImeiSIM2;
	private boolean isSIM1mIeady;
	private boolean mIsSIM2Ready;

	public String getImeiSIM1() {
		return mImeiSIM1;
	}

	/*public static void setImeiSIM1(String imeiSIM1) {
	        TelephonyInfo.imeiSIM1 = imeiSIM1;
	    }*/

	public String getImeiSIM2() {
		return mImeiSIM2;
	}

	/*public static void setImeiSIM2(String imeiSIM2) {
	        TelephonyInfo.imeiSIM2 = imeiSIM2;
	    }*/

	public boolean isSIM1Ready() {
		return isSIM1mIeady;
	}

	/*public static void setSIM1Ready(boolean isSIM1Ready) {
	        TelephonyInfo.isSIM1Ready = isSIM1Ready;
	    }*/

	public boolean isSIM2Ready() {
		return mIsSIM2Ready;
	}

	/*public static void setSIM2Ready(boolean isSIM2Ready) {
	        TelephonyInfo.isSIM2Ready = isSIM2Ready;
	    }*/

	public boolean isDualSIM() {
		return mImeiSIM2 != null;
	}

	private TelephonyInfo() {
	}

	public static TelephonyInfo getInstance(Context context){

		if(telephonyInfo == null) {

			telephonyInfo = new TelephonyInfo();

			TelephonyManager telephonyManager = ((TelephonyManager) context.getSystemService(Context.TELEPHONY_SERVICE));

			telephonyInfo.mImeiSIM1 = telephonyManager.getDeviceId();;
			telephonyInfo.mImeiSIM2 = null;

			try {
				telephonyInfo.mImeiSIM1 = getDeviceIdBySlot(context, "getDeviceIdGemini", 0);
				telephonyInfo.mImeiSIM2 = getDeviceIdBySlot(context, "getDeviceIdGemini", 1);
			} catch (GeminiMethodNotFoundException e) {
				e.printStackTrace();

				try {
					telephonyInfo.mImeiSIM1 = getDeviceIdBySlot(context, "getDeviceId", 0);
					telephonyInfo.mImeiSIM2 = getDeviceIdBySlot(context, "getDeviceId", 1);
				} catch (GeminiMethodNotFoundException e1) {
					//Call here for next manufacturer's predicted method name if you wish
					e1.printStackTrace();
				}
			}

			telephonyInfo.isSIM1mIeady = telephonyManager.getSimState() == TelephonyManager.SIM_STATE_READY;
			telephonyInfo.mIsSIM2Ready = false;

			try {
				telephonyInfo.isSIM1mIeady = getSIMStateBySlot(context, "getSimStateGemini", 0);
				telephonyInfo.mIsSIM2Ready = getSIMStateBySlot(context, "getSimStateGemini", 1);
			} catch (GeminiMethodNotFoundException e) {

				e.printStackTrace();

				try {
					telephonyInfo.isSIM1mIeady = getSIMStateBySlot(context, "getSimState", 0);
					telephonyInfo.mIsSIM2Ready = getSIMStateBySlot(context, "getSimState", 1);
				} catch (GeminiMethodNotFoundException e1) {
					//Call here for next manufacturer's predicted method name if you wish
					e1.printStackTrace();
				}
			}
		}

		return telephonyInfo;
	}

	private static String getDeviceIdBySlot(Context context, String predictedMethodName, int slotID) throws GeminiMethodNotFoundException {

		String imei = null;

		TelephonyManager telephony = (TelephonyManager) context.getSystemService(Context.TELEPHONY_SERVICE);

		try{

			Class<?> telephonyClass = Class.forName(telephony.getClass().getName());

			Class<?>[] parameter = new Class[1];
			parameter[0] = int.class;
			Method getSimID = telephonyClass.getMethod(predictedMethodName, parameter);

			Object[] obParameter = new Object[1];
			obParameter[0] = slotID;
			Object ob_phone = getSimID.invoke(telephony, obParameter);

			if(ob_phone != null){
				imei = ob_phone.toString();

			}
		} catch (Exception e) {
			e.printStackTrace();
			throw new GeminiMethodNotFoundException(predictedMethodName);
		}

		return imei;
	}
	
	private static  boolean getSIMStateBySlot(Context context, String predictedMethodName, int slotID) throws GeminiMethodNotFoundException {

		boolean isReady = false;

		TelephonyManager telephony = (TelephonyManager) context.getSystemService(Context.TELEPHONY_SERVICE);

		try{

			Class<?> telephonyClass = Class.forName(telephony.getClass().getName());

			Class<?>[] parameter = new Class[1];
			parameter[0] = int.class;
			Method getSimStateGemini = telephonyClass.getMethod(predictedMethodName, parameter);

			Object[] obParameter = new Object[1];
			obParameter[0] = slotID;
			Object ob_phone = getSimStateGemini.invoke(telephony, obParameter);

			if(ob_phone != null){
				int simState = Integer.parseInt(ob_phone.toString());
				if(simState == TelephonyManager.SIM_STATE_READY){
					isReady = true;
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
			throw new GeminiMethodNotFoundException(predictedMethodName);
		}

		return isReady;
	}


	private static class GeminiMethodNotFoundException extends Exception {

		private static final long serialVersionUID = -996812356902545308L;

		public GeminiMethodNotFoundException(String info) {
			super(info);
		}
	}
	public static void printTelephonyManagerMethodNamesForThisDevice(Context context) {

	    TelephonyManager telephony = (TelephonyManager) context.getSystemService(Context.TELEPHONY_SERVICE);
	    Class<?> telephonyClass;
	    try {
	        telephonyClass = Class.forName(telephony.getClass().getName());
	        Method[] methods = telephonyClass.getMethods();
	        for (int idx = 0; idx < methods.length; idx++) {

	            Log.i(TAG, "" + methods[idx] + " declared by " + methods[idx].getDeclaringClass());
	        }
	    } catch (ClassNotFoundException e) {
	        e.printStackTrace();
	    }
	} 
}

