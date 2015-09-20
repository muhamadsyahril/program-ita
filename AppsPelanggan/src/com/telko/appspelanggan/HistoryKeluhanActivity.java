package com.telko.appspelanggan;

import java.util.ArrayList;
import java.util.HashMap;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import android.app.ListActivity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.Window;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;
import com.telko.appspelanggan.library.DatabaseHandler;
import com.telko.appspelanggan.library.UserFunctions;

public class HistoryKeluhanActivity extends ListActivity{

	UserFunctions userFunctions;
	private static final String ARRTIKET 		= "notiket";
	private static final String ARRKELUHAN		= "keluhan";
	private static final String ARRSTATUS		= "status";
	private static final String USR_NOID 		= "nomerid";
	private static final String ARRSOLUSI 		= "solusi";


	JSONArray historykeluhan = null;
	ArrayList<HashMap<String, String>> daftar_keluhan = new ArrayList<HashMap<String, String>>();
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.history);
		
		DatabaseHandler db = new DatabaseHandler(getApplicationContext());
        HashMap<String, String> user = db.getUserDetails();
        
        String uid = user.get(USR_NOID);
		
		UserFunctions userFunction = new UserFunctions();
		
		JSONObject json = userFunction.getDataKeluhanById(uid);
		
		
		try {
			historykeluhan = json.getJSONArray("keluhan");
			
			for(int i = 0; i < historykeluhan.length(); i++){
				JSONObject ar = historykeluhan.getJSONObject(i);
				String tiket = ar.getString(ARRTIKET);
				String keluhan = ar.getString(ARRKELUHAN);
				String status = ar.getString(ARRSTATUS);
				String solusi = ar.getString(ARRSOLUSI);
				HashMap<String, String> map = new HashMap<String, String>();
				map.put(ARRTIKET, tiket);
				map.put(ARRKELUHAN, keluhan);
				map.put(ARRSTATUS, status);
				map.put(ARRSOLUSI, solusi);
				daftar_keluhan.add(map);
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		this.adapter_listview();
	}
	
	public void adapter_listview() {

		ListAdapter adapter = new SimpleAdapter(this, daftar_keluhan,
				R.layout.history_detail,
				new String[] { ARRTIKET, ARRKELUHAN, ARRSOLUSI, ARRSTATUS}, new int[] {
				R.id.tiket, R.id.keluhan, R.id.solusi, R.id.status});

		setListAdapter(adapter);
		
	}
	
	
	@Override
	public void onBackPressed() {
	   Log.d("CDA", "onBackPressed Called");
	   Intent menu = new Intent(getApplicationContext(), MainActivity.class);
	   menu.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
		startActivity(menu);
		
		finish();
	}
	
}
