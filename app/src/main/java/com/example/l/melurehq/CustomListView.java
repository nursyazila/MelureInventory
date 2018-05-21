package com.example.l.melurehq;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.io.InputStream;

/**
 * Created by L on 5/19/2018.
 */

public class CustomListView extends ArrayAdapter<String> {

    private String[] id;
    private String[] profilename;
    private String[] email;
    private String[] invquantity;
    private String[] invprice;
    private String[] imagepath;
    private Activity context;
    Bitmap bitmap;
    public CustomListView(Activity context, String[] id, String[] profilename,String[] email,String[] invquantity,String[] invprice,String[] imagepath) {
        super(context, R.layout.layout,profilename);

        this.context=context;
        this.id = id;
        this.profilename=profilename;
        this.email=email;
        this.invquantity=invquantity;
        this.invprice =invprice;
        this.imagepath=imagepath;

    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View r = convertView;
        ViewHolder viewHolder = null;

        if(r==null){
            LayoutInflater layoutInflater = context.getLayoutInflater();
            r=layoutInflater.inflate(R.layout.layout,null,true);
            viewHolder= new ViewHolder(r);
            r.setTag(viewHolder);
        }else{
            viewHolder=(ViewHolder)r.getTag();
        }

        viewHolder.tvw1.setText(profilename[position]);
        viewHolder.tvw2.setText(email[position]);
        viewHolder.tvw3.setText(invquantity[position]);
        new GetImageFromURL(viewHolder.ivw).execute(imagepath[position]);
        return r;
    }

    class ViewHolder {
        TextView tvw1;
        TextView tvw2;
        TextView tvw3;
        ImageView ivw;

        ViewHolder(View v){
            tvw1=(TextView)v.findViewById(R.id.tvprofilename);
            tvw2=(TextView)v.findViewById(R.id.tvprofilename2);
            tvw3=(TextView)v.findViewById(R.id.tvprofilename3);
            ivw=(ImageView)v.findViewById(R.id.imageView);


        }
    }

    public class GetImageFromURL extends AsyncTask<String,Void,Bitmap>{
        ImageView imgView;
        public GetImageFromURL(ImageView imgv){
            this.imgView=imgv;
        }
        @Override
        protected Bitmap doInBackground(String... url) {
            String urldisplay= url[0];
            bitmap=null;
            try {
                InputStream ist = new java.net.URL(urldisplay).openStream();
                bitmap= BitmapFactory.decodeStream(ist);
            }catch (Exception ex){
                ex.printStackTrace();
            }
            return bitmap;
        }

        @Override
        protected void onPostExecute(Bitmap bitmap) {
            super.onPostExecute(bitmap);
            imgView.setImageBitmap(bitmap);


        }
    }
}
