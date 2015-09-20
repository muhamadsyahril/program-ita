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
import android.widget.AdapterView;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;
import com.telko.appspelanggan.library.DatabaseHandler;
import com.telko.appspelanggan.library.UserFunctions;

public class KeluhanActivity extends ListActivity {
	
	UserFunctions userFunctions;
	private static final String ARRID	 		= "idkel";
	private static final String ARRTIKET 		= "notiket";
	private static final String ARRTGL	 		= "tgl";
	private static final String ARRKELUHAN		= "keluhan";
	private static final String ARRSTATUS		= "status";
	private static final String USR_NOID 		= "nomerid";



	JSONArray keluhan = null;
	ArrayList<HashMap<String, String>> datakeluhan = new ArrayList<HashMap<String, String>>();

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.menu_teknisi);
		
		DatabaseHandler db = new DatabaseHandler(getApplicationContext());
        HashMap<String, String> user = db.getUserDetails();
        
        String uid = user.get(USR_NOID);
        
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.getKeluhan(uid);
		
		try {
			keluhan = json.getJSONArray("keluhan");
			for(int i = 0; i < keluhan.length(); i++){
				JSONObject ar = keluhan.getJSONObject(i);
				String id = ar.getString(ARRID);
				String tiket = ar.getString(ARRTIKET);
				String tgl = ar.getString(ARRTGL);
				String keluhan = ar.getString(ARRKELUHAN);
				String status = ar.getString(ARRSTATUS);
				HashMap<String, String> map = new HashMap<String, String>();
				map.put(ARRID, id);
				map.put(ARRTIKET, tiket);
				map.put(ARRTGL, tgl);
				map.put(ARRKELUHAN, keluhan);
				map.put(ARRSTATUS, status);
				datakeluhan.add(map);
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		this.adapter_listview();
	}
	
	public void adapter_listview() {

		ListAdapter adapter = new SimpleAdapter(this, datakeluhan,
				R.layout.getkeluhan_item,
				new String[] { ARRID, ARRTIKET, ARRTGL, ARRKELUHAN, ARRSTATUS}, new int[] {
				R.id.id, R.id.notiket, R.id.tgl, R.id.keluhan, R.id.status});

		setListAdapter(adapter);
		ListView lv = getListView();
		lv.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,int position, long id) {
				String idkeluhan = ((TextView) view.findViewById(R.id.id)).getText().toString();
				
				Intent in = new Intent(KeluhanActivity.this, PostSolusiActivity.class);
				in.putExtra(ARRID, idkeluhan);
				startActivity(in);

			}
		});
		
	}


}
