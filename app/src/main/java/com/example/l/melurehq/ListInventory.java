package com.example.l.melurehq;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.HashMap;

public class ListInventory extends AppCompatActivity {

    String urlAddress = "http://172.20.10.2/Melure/getinventory.php";
    String HttpUrlDeleteRecord = "http://172.20.10.2/Melure/updateStatus.php";

    String[] id;
    String[] name;
    String[] desc;
    String[] invquantity;
    String[] invPrice;
    String [] imagepath;
    ListView listView;
    BufferedInputStream is;
    String line = null;
    String result = null;
    ProgressDialog progressDialog;
    String finalResult ;
    HashMap<String,String> hashMap = new HashMap<>();
    HttpParse httpParse = new HttpParse();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_success);

        listView = (ListView)findViewById(R.id.lview);
        StrictMode.setThreadPolicy(new StrictMode.ThreadPolicy.Builder().permitNetwork().build());

        collectData();
        CustomListView customListView =new CustomListView(this,id,name,desc, invquantity, invPrice,imagepath);
        listView.setAdapter(customListView);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
              final  String id1= id[+i];
               final String name1 = name[+i];
              final  String description1 = desc[+i];
               final String quantitiy1 = invquantity[+i];
               final String price1 = invPrice[+i];
              final  String image = imagepath[+i];


                AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(ListInventory.this);

                // set title
                alertDialogBuilder.setTitle("What  do you want to do?");
                alertDialogBuilder.setInverseBackgroundForced(false);

                // set dialog message
                alertDialogBuilder
                        .setCancelable(true)
                        .setPositiveButton("Update", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {


                                Intent intent = new Intent(ListInventory.this,UpdateProductActivity.class);
                                intent.putExtra("name", name1);
                                intent.putExtra("desc", description1);
                                intent.putExtra("quantity",quantitiy1);
                                intent.putExtra("price",price1);
                                intent.putExtra("id",id1);
                                intent.putExtra("image",image);
                                startActivity(intent);
                                Toast.makeText(ListInventory.this,"You clicked "+name1,Toast.LENGTH_SHORT).show();


                                dialog.cancel();

                            }
                        })
                        .setNegativeButton("Delete", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {

                                InventoryDelete(id1);

                                dialog.cancel();


                            }
                        });

                // create alert dialog

                AlertDialog alertDialog = alertDialogBuilder.create();
                // show it
                alertDialog.show();




            }
        });
    }


    public void InventoryDelete(final String InventoryID) {

        class InventoryDeleteClass extends AsyncTask<String, Void, String> {

            @Override
            protected void onPreExecute() {
                super.onPreExecute();

                progressDialog = ProgressDialog.show(ListInventory.this, "Deleting Data", null, false, false);
            }

            @Override
            protected void onPostExecute(String httpResponseMsg) {

                super.onPostExecute(httpResponseMsg);

                progressDialog.dismiss();

                Toast.makeText(ListInventory.this, httpResponseMsg.toString(), Toast.LENGTH_LONG).show();

                Intent intent = new Intent(ListInventory.this,ListInventory.class);
                finish();
                startActivity(intent);


            }

            @Override
            protected String doInBackground(String... params) {

                hashMap.put("InventoryID", params[0]);

                finalResult = httpParse.postRequest(hashMap, HttpUrlDeleteRecord);

                return finalResult;
            }
        }

        InventoryDeleteClass inventoryDeleteClass = new InventoryDeleteClass();

        inventoryDeleteClass.execute(InventoryID);
    }


    private void collectData() {

        try{
            URL  url = new URL(urlAddress);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("GET");
            is = new BufferedInputStream(con.getInputStream());
        }
        catch (Exception ex){
            ex.printStackTrace();
        }

        try{
            BufferedReader br = new BufferedReader(new InputStreamReader(is));
            StringBuilder sb = new StringBuilder();
            while((line=br.readLine())!=null ){
                sb.append(line+"\n");
            }
            is.close();
            result=sb.toString();
        }
        catch (Exception ex){
            ex.printStackTrace();
        }

        try{
            JSONArray ja=new JSONArray(result);
            JSONObject jo = null;
            id =new String[ja.length()];
            name=new String[ja.length()];
            desc= new String[ja.length()];
            invquantity = new String[ja.length()];
            invPrice = new String[ja.length()];
            imagepath =new String[ja.length()];

            for(int i=0;i<ja.length();i++){
                jo=ja.getJSONObject(i);
                id[i] = jo.getString("inventory_id");
                name[i]= jo.getString("inventory_name");
                desc[i] = jo.getString("inventory_description");
                invquantity[i] = jo.getString("instock_quantity");
                invPrice[i] = jo.getString("unit_price");
                imagepath[i] = jo.getString("inventory_image");

            }
        }
        catch (Exception ex){
            ex.printStackTrace();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.main, menu);
      //  ActionItemBadge.update(this, menu.findItem(R.id.action_item_one), FontAwesome.Icon.faw_bell, ActionItemBadge.BadgeStyles.RED,allmissed);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        //noinspection SimplifiableIfStatement
        if (id == R.id.action_item_one) {
            Intent intentActivity = new Intent(this, InsertProductActivity.class);
            startActivity(intentActivity);
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}
