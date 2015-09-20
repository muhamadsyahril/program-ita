package com.telko.appspelanggan;

import java.util.HashMap;
import org.json.JSONException;
import org.json.JSONObject;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.telko.appspelanggan.library.DatabaseHandler;
import com.telko.appspelanggan.library.UserFunctions;

public class PostKeluhanActivity  extends Activity{
	
	private static final String USR_NOID = "nomerid";
	private static final String ARR_DETAIL		= "detail";
	private static String KEY_SUCCESS = "success";
	Button btnsend;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.input_keluhan);
		
		Intent in = getIntent();
        String nama = in.getStringExtra(ARR_DETAIL);
        
        final EditText jeniskel =(EditText) findViewById(R.id.jenis);
        final EditText detailkel =(EditText) findViewById(R.id.detail);
        btnsend = (Button) findViewById(R.id.btnSend);
        
        jeniskel.setText(nama);
        
        btnsend.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {
				
				String nama = jeniskel.getText().toString();
				String keluhan = detailkel.getText().toString();
				
				DatabaseHandler db = new DatabaseHandler(getApplicationContext());
		        HashMap<String, String> user = db.getUserDetails();
		        
		        String uid = user.get(USR_NOID);
	
		        UserFunctions userFunction = new UserFunctions();
		        
				JSONObject json = userFunction.inputKeluhan(nama, keluhan, uid);
				
        try {
			if (json.getString(KEY_SUCCESS) != null) {
				String res = json.getString(KEY_SUCCESS); 

				if(Integer.parseInt(res) == 1){
					
					Toast.makeText(PostKeluhanActivity.this, "Success kirim keluhan", Toast.LENGTH_SHORT).show();
					
					Intent dashboard = new Intent(getApplicationContext(), MainActivity.class);
					dashboard.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					startActivity(dashboard);
					
					finish();
				}else{
					// Error in login
					Toast.makeText(PostKeluhanActivity.this, "Error kirim keluhan", Toast.LENGTH_SHORT).show();
					
					Intent dashboard = new Intent(getApplicationContext(), MainActivity.class);
					dashboard.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					startActivity(dashboard);
					
					finish();

				}
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
        
	  }
	});
        
		
	}

}
