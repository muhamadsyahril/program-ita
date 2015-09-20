package com.telko.appspelanggan;

import java.util.ArrayList;
import java.util.HashMap;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import android.os.Bundle;
import android.app.ListActivity;
import android.content.Intent;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.AdapterView;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;
import com.telko.appspelanggan.library.UserFunctions;


public class JenisKeluhanActivity extends ListActivity {
	UserFunctions userFunctions;
	private static final String ARRID_JENIS 	= "id_jenis_kel";
	private static final String ARR_DETAIL		= "detail";


	JSONArray jenisKeluhan = null;
	ArrayList<HashMap<String, String>> daftar_keluhan = new ArrayList<HashMap<String, String>>();
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.jenis_keluhan);
		
		UserFunctions userFunction = new UserFunctions();
		
		JSONObject json = userFunction.getJenisKeluhan();
		
		
		try {
			jenisKeluhan = json.getJSONArray("keluhan");
			
			for(int i = 0; i < jenisKeluhan.length(); i++){
				JSONObject ar = jenisKeluhan.getJSONObject(i);
				String id = ar.getString(ARRID_JENIS);
				String detail = ar.getString(ARR_DETAIL);
				HashMap<String, String> map = new HashMap<String, String>();
				map.put(ARRID_JENIS, id);
				map.put(ARR_DETAIL, detail);
				daftar_keluhan.add(map);
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		this.adapter_listview();
	}
	
	public void adapter_listview() {

		ListAdapter adapter = new SimpleAdapter(this, daftar_keluhan,
				R.layout.getkeluhan2_item,
				new String[] { ARRID_JENIS, ARR_DETAIL}, new int[] {
				R.id.id, R.id.keluhan});

		setListAdapter(adapter);
		ListView lv = getListView();
		lv.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,int position, long id) {
				String jnskeluhan = ((TextView) view.findViewById(R.id.id)).getText().toString();
				String dtkeluhan = ((TextView) view.findViewById(R.id.keluhan)).getText().toString();
				
				Intent in = new Intent(JenisKeluhanActivity.this, PostKeluhanActivity.class);
				in.putExtra(ARRID_JENIS, jnskeluhan);
				in.putExtra(ARR_DETAIL, dtkeluhan);
				startActivity(in);

			}
		});

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
