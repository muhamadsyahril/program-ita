/**
 * Author: Ravi Tamada
 * URL: www.androidhive.info
 * twitter: http://twitter.com/ravitamada
 * */
package com.telko.appspelanggan;

import org.json.JSONException;
import org.json.JSONObject;
import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.telko.appspelanggan.library.DatabaseHandler;
import com.telko.appspelanggan.library.UserFunctions;

@TargetApi(Build.VERSION_CODES.GINGERBREAD)
@SuppressLint("NewApi")
public class LoginActivity extends Activity {
	Button btnLogin;
	Button btnLinkToRegister;
	EditText inputUsername;
	EditText inputPassword;
	

	// JSON Response node names
	private static String KEY_SUCCESS = "success";
	private static String KEY_NOID = "uid";
	private static String KEY_NAME = "name";
	private static String KEY_MENU = "menu";
	private static String KEY_CREATED_AT = "created_at";

	@SuppressLint("NewApi")
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		if (android.os.Build.VERSION.SDK_INT > 9) {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
            StrictMode.setThreadPolicy(policy);
            System.out.println("*** My thread is now configured to allow connection");
        }
		
		setContentView(R.layout.activity_main);

		// Importing all assets like buttons, text fields
		inputUsername = (EditText) findViewById(R.id.username);
		inputPassword = (EditText) findViewById(R.id.password);
		btnLogin = (Button) findViewById(R.id.button_login);
	
		
		
		// Login button Click Event
		btnLogin.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {
				 
				
				String username = inputUsername.getText().toString();
				String password = inputPassword.getText().toString();
				UserFunctions userFunction = new UserFunctions();
				
				Log.d("Button", "Login");
				JSONObject json = userFunction.loginUser(username, password);
				
				// check for login response
				try {
					if (json.getString(KEY_SUCCESS) != null) {
						
						String res = json.getString(KEY_SUCCESS); 
						
						if(Integer.parseInt(res) == 1){
							
							// user successfully logged in
							// Store user details in SQLite Database
							DatabaseHandler db = new DatabaseHandler(getApplicationContext());
							JSONObject json_user = json.getJSONObject("user");
							
							// Clear all previous data in database
							userFunction.logoutUser(getApplicationContext());
							db.addUser(json_user.getString(KEY_NOID),json_user.getString(KEY_NAME), json_user.getString(KEY_MENU), json_user.getString(KEY_CREATED_AT));						
							
							String menulevel = json_user.getString(KEY_MENU);
							
							if(Integer.parseInt(menulevel) == 1){
								Intent dashboard = new Intent(getApplicationContext(), LaporanActivity.class);
								dashboard.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
								startActivity(dashboard);
							}else if(Integer.parseInt(menulevel) == 2){
								Intent dashboard = new Intent(getApplicationContext(), MainActivity.class);
								dashboard.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
								startActivity(dashboard);
							}else{
								Intent dashboard = new Intent(getApplicationContext(), KeluhanActivity.class);
								dashboard.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
								startActivity(dashboard);
							
							}
				
							finish();
						}else{
							// Error in login
							Toast.makeText(LoginActivity.this, "Incorrect username/password", Toast.LENGTH_SHORT).show();

						}
					}
				} catch (JSONException e) {
					e.printStackTrace();
				}
			}
		});


	}
}
