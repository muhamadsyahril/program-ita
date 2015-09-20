package com.telko.appspelanggan;

import java.util.ArrayList;
import java.util.HashMap;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import android.os.Bundle;
import android.app.ListActivity;
import android.content.Intent;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;

import com.telko.appspelanggan.library.DatabaseHandler;
import com.telko.appspelanggan.library.UserFunctions;




public class MainActivity extends ListActivity {
	Button btnHistory;
	Button btnPostComplain;
	
	private static final String USR_NOID = "nomerid";
	//private static final String USR_LVL = "level";
	UserFunctions userFunctions;
	private static final String AR_ID = "id_pelanggan";
	private static final String AR_NAMA = "nama_pel";
	private static final String AR_ADDRESS = "alamat_pel";
	private static final String AR_PSTN = "telp_pel";
	private static final String AR_SPEEDY = "speedyno";
	
	JSONArray pelanggan = null;
	ArrayList<HashMap<String, String>> daftar_pelanggan = new ArrayList<HashMap<String, String>>();


	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.dashboard_layout);
		
			DatabaseHandler db = new DatabaseHandler(getApplicationContext());
	        HashMap<String, String> user = db.getUserDetails();
	        
	        String uid = user.get(USR_NOID);

	        UserFunctions userFunction = new UserFunctions();
	        
	        JSONObject json = userFunction.getDataPelanggan(uid);
	        
	        try {
				pelanggan = json.getJSONArray("pelanggan");
				
				for(int i = 0; i < pelanggan.length(); i++){
					JSONObject ar = pelanggan.getJSONObject(i);
					
					

					String id = ar.getString(AR_ID);
					String nama = ar.getString(AR_NAMA);
					String address = ar.getString(AR_ADDRESS);
					String produk = ar.getString(AR_PSTN);
					String area = ar.getString(AR_SPEEDY);

					HashMap<String, String> map = new HashMap<String, String>();

					map.put(AR_ID, id);
					map.put(AR_NAMA, nama);
					map.put(AR_ADDRESS, address);
					map.put(AR_PSTN, produk);
					map.put(AR_SPEEDY, area);

					daftar_pelanggan.add(map);
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}

			
			this.adapter_listview();
		
	}
	
	
	public void adapter_listview() {

		ListAdapter adapter = new SimpleAdapter(this, daftar_pelanggan,
				R.layout.getpelanggan_item,
				new String[] { AR_NAMA, AR_ADDRESS, AR_PSTN, AR_SPEEDY, AR_ID}, new int[] {
						R.id.nama_pelanggan, R.id.alamat_pelanggan, R.id.produk_pelanggan, R.id.area_pelanggan, R.id.kode});

		setListAdapter(adapter);
		
		
		btnHistory = (Button) findViewById(R.id.button_history);
		btnPostComplain = (Button) findViewById(R.id.button_Post);
		
		btnHistory.setOnClickListener(new View.OnClickListener() {

			@Override
			public void onClick(View arg0) {
				
				Intent historykeluhan = new Intent(getApplicationContext(), HistoryKeluhanActivity.class);
				
				historykeluhan.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(historykeluhan);
			
				finish();
				
			}
		
		});
		
		
		btnPostComplain.setOnClickListener(new View.OnClickListener() {

			@Override
			public void onClick(View arg0) {
				
				Intent jeniskeluhan = new Intent(getApplicationContext(), JenisKeluhanActivity.class);
			
				jeniskeluhan.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(jeniskeluhan);
			
				finish();
				
			}
		
		});
		


		
	}
	
	
}
