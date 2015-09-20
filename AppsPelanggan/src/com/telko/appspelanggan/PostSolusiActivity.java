package com.telko.appspelanggan;


import org.json.JSONException;
import org.json.JSONObject;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.telko.appspelanggan.library.UserFunctions;

public class PostSolusiActivity extends Activity{
	
	private static final String ARRID	 		= "idkel";
	private static String KEY_SUCCESS 			= "success";
	Button btnsendSolusi;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.input_solusi);
		
		Intent in = getIntent();
        String idkeluhan = in.getStringExtra(ARRID);
        
        final EditText id =(EditText) findViewById(R.id.id);
        final EditText detsolusi =(EditText) findViewById(R.id.detail_solusi);
        btnsendSolusi = (Button) findViewById(R.id.btnSendsolusi);
        
        id.setText(idkeluhan);
        
        btnsendSolusi.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {
				
				String idkel = id.getText().toString();
				String solusi = detsolusi.getText().toString();
				
		       UserFunctions userFunction = new UserFunctions();
		       Log.d("Button", "btn solusi");
		       JSONObject json = userFunction.inputSolusi(idkel, solusi);
		       
		       try {
		    	   if (json.getString(KEY_SUCCESS) != null) {
		    		   String res = json.getString(KEY_SUCCESS); 

		    		   if(Integer.parseInt(res) == 1){
					
		    			   Toast.makeText(PostSolusiActivity.this, "Success kirim Solusi", Toast.LENGTH_SHORT).show();
					
		    			   Intent dashboard = new Intent(getApplicationContext(), KeluhanActivity.class);
		    			   dashboard.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		    			   startActivity(dashboard);
					
		    			   finish();
		    		   }else{
					
		    			   Toast.makeText(PostSolusiActivity.this, "Error kirim Solusi", Toast.LENGTH_SHORT).show();
					
		    			   Intent dashboard = new Intent(getApplicationContext(), KeluhanActivity.class);
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
