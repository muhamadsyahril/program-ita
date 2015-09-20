/**
 * Author: Ravi Tamada
 * URL: www.androidhive.info
 * twitter: http://twitter.com/ravitamada
 * */
package com.telko.appspelanggan.library;

import java.util.ArrayList;
import java.util.List;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;
import android.content.Context;


public class UserFunctions {
	
	private JSONParser jsonParser;
	
	private static String loginURL = "http://10.0.2.2/telkom/api_login";
	
	private static String login_tag 		= "login";
	private static String getkeluhan_tag 	= "getkeluhan";
	private static String getJenisKeluhan 	= "jeniskeluhan";
	private static String getDataPelanggan 	= "getpelanggan";
	private static String inputKeluhantag 	= "inputkeluhan";
	private static String getKeluhanById 	= "keluhanbyid";
	private static String inputSolusitag	= "inputsolusi";
	private static String getallkeluhan		= "getallkeluhan";
	
	// constructor
	public UserFunctions(){
		jsonParser = new JSONParser();
	}
	
	/**
	 * function make Login Request
	 * @param email
	 * @param password
	 * */
	public JSONObject loginUser(String username, String password){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", login_tag));
		params.add(new BasicNameValuePair("username", username));
		params.add(new BasicNameValuePair("password", password));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	
	public boolean isUserLoggedIn(Context context){
		DatabaseHandler db = new DatabaseHandler(context);
		int count = db.getRowCount();
		if(count > 0){
			// user logged in
			return true;
		}
		return false;
	}
	
	/**
	 * Function to logout user
	 * Reset Database
	 * */
	public boolean logoutUser(Context context){
		DatabaseHandler db = new DatabaseHandler(context);
		db.resetTables();
		return true;
	}
	
	public JSONObject getKeluhan(String uid){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", getkeluhan_tag));
		params.add(new BasicNameValuePair("idpetugas", uid));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	public JSONObject getAllKeluhan(){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", getallkeluhan));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	public JSONObject getJenisKeluhan(){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", getJenisKeluhan));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	public JSONObject inputKeluhan(String nama, String keluhan, String uid){
		
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", inputKeluhantag));
		params.add(new BasicNameValuePair("jenis", nama));
		params.add(new BasicNameValuePair("keluhan", keluhan));
		params.add(new BasicNameValuePair("idpelanggan", uid));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		//return json
		//Log.e("JSON", json.toString());
		return json;
	}
	
	public JSONObject inputSolusi(String idkel, String solusi){
		
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", inputSolusitag));
		params.add(new BasicNameValuePair("idkeluhan", idkel));
		params.add(new BasicNameValuePair("solusi", solusi));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		//return json
		//Log.e("JSON", json.toString());
		return json;
		}
	
	public JSONObject getDataPelanggan(String uid){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", getDataPelanggan));
		params.add(new BasicNameValuePair("nomerid", uid));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	public JSONObject getDataKeluhanById(String uid){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", getKeluhanById));
		params.add(new BasicNameValuePair("nomerid", uid));
		JSONObject json = jsonParser.getJSONFromUrl(loginURL, params);
		// return json
		// Log.e("JSON", json.toString());
		return json;
	}
	
	
	


	
}
