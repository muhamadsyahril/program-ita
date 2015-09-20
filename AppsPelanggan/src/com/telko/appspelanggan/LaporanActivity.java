package com.telko.appspelanggan;

import java.util.ArrayList;
import java.util.HashMap;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import android.os.Bundle;
import android.app.ListActivity;
import android.view.Window;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;

import com.telko.appspelanggan.library.UserFunctions;

public class LaporanActivity extends ListActivity {
	
	UserFunctions userFunctions;

	private static final String ARRID 			= "idkel";
	private static final String ARRKELUHAN		= "jenis";
	private static final String ARRSTATUS		= "status";
	private static final String ARRNAMA 		= "nama_pel";


	JSONArray keluhan = null;
	ArrayList<HashMap<String, String>> datakeluhan = new ArrayList<HashMap<String, String>>();

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.menu_laporan);
        
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.getAllKeluhan();
		
		try {
			keluhan = json.getJSONArray("keluhan");
			for(int i = 0; i < keluhan.length(); i++){
				JSONObject ar = keluhan.getJSONObject(i);
	
				String id = ar.getString(ARRID);
				String keluhan = ar.getString(ARRKELUHAN);
				String status = ar.getString(ARRSTATUS);
				String namapel = ar.getString(ARRNAMA);
				
				HashMap<String, String> map = new HashMap<String, String>();
				
				map.put(ARRID, id);
				map.put(ARRKELUHAN, keluhan);
				map.put(ARRSTATUS, status);
				map.put(ARRNAMA, namapel);
				datakeluhan.add(map);
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		this.adapter_listview();
	}
	
	public void adapter_listview() {

		ListAdapter adapter = new SimpleAdapter(this, datakeluhan,
				R.layout.laporan,
				new String[] { ARRID, ARRNAMA, ARRKELUHAN, ARRSTATUS}, new int[] {
				R.id.id_keluhan,R.id.pelanggan, R.id.listKeluhan, R.id.statusKel});

		setListAdapter(adapter);
		
	}


}
