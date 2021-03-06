package com.example.l.melurehq;

import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.TextUtils;
import android.widget.Toast;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.HashMap;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.widget.EditText;
import android.widget.ImageView;
import android.net.Uri;
import android.provider.MediaStore;
import java.io.BufferedReader;
import java.net.URLEncoder;
import java.util.Map;
import java.io.BufferedWriter;
import java.io.OutputStreamWriter;
import java.net.URL;
import javax.net.ssl.HttpsURLConnection;
import java.io.UnsupportedEncodingException;
import android.util.Base64;
import android.view.View;
import android.widget.Button;

public class UpdateProductActivity extends AppCompatActivity {

    Bitmap bitmap;

    boolean check = true;

    Button SelectImageGallery, UploadImageServer;

    ImageView imageView;

    String URLIMAGE= "";

    EditText imageName,imageDesc,imageQuantity,imagePrice;

    ProgressDialog progressDialog ;

    String GetImageNameEditText,GetImageDescEditText,GetImagePriceEditText,GetImageQuantityEditText,GetImageIdEditText;

    String ImageId = "image_id" ;
    String ImageName = "image_name" ;
    String ImageDesc = "image_desc" ;
    String ImageQuantity = "image_quantity" ;
    String ImagePrice = "image_price" ;
    String ImagePath = "image_path" ;

    String ServerUploadPath ="http://172.20.10.2/Melure/updateProduct.php" ;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_product);
        imageView = (ImageView)findViewById(R.id.imageView);
        imageName = (EditText)findViewById(R.id.editTextImageName);
        imageDesc = (EditText)findViewById(R.id.editTextImageDescription);
        imageQuantity = (EditText)findViewById(R.id.editTextImageQuantity);
        imagePrice = (EditText)findViewById(R.id.editTextImagePrice);
        Intent intent = getIntent();
        String id = intent.getExtras().getString("id");
        String name = intent.getExtras().getString("name");
        String desc = intent.getExtras().getString("desc");
        String quantity = intent.getExtras().getString("quantity");
        String price = intent.getExtras().getString("price");
        URLIMAGE = intent.getExtras().getString("image");

        imageName.setText(name);
        imageDesc.setText(desc);
        imageQuantity.setText(quantity);
        imagePrice.setText(price);
        SelectImageGallery = (Button)findViewById(R.id.buttonSelect);
        UploadImageServer = (Button)findViewById(R.id.buttonUpload);

        new getImageFromUrl(imageView).execute(URLIMAGE);

        SelectImageGallery.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent intent = new Intent();

                intent.setType("image/*");

                intent.setAction(Intent.ACTION_GET_CONTENT);

                startActivityForResult(Intent.createChooser(intent, "Select Image From Gallery"), 1);

            }
        });


        UploadImageServer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Runnable runnable = new Runnable() {
                    @Override
                    public void run() {
                        Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                        startActivityForResult(intent,0);

                        runOnUiThread(new Runnable() {
                            @Override
                            public void run() {
                                Intent intent = getIntent();
                                String id = intent.getExtras().getString("id");
                                GetImageIdEditText = id;
                                GetImageDescEditText = imageDesc.getText().toString();
                                GetImagePriceEditText = imagePrice.getText().toString();
                                GetImageQuantityEditText = imageQuantity.getText().toString();
                                GetImageNameEditText = imageName.getText().toString();

                                if(TextUtils.isEmpty(GetImageNameEditText)  || TextUtils.isEmpty(GetImageDescEditText)|| TextUtils.isEmpty(GetImagePriceEditText) || TextUtils.isEmpty(GetImageQuantityEditText) || ImagePath.isEmpty()) {
                                    imageName.setError(" Please fill this field");
                                    imageDesc.setError(" Please fill this field");
                                    imageQuantity.setError("Please fill this field");
                                    imagePrice.setError("Please fill this field");
                                    return;
                                }
                                else {
                                    ImageUploadToServerFunction();
                                }

                            }
                        });
                    }
                };

                Thread thread = new Thread(runnable);
                thread.start();


            }
        });
    }

    @Override
    protected void onActivityResult(int RC, int RQC, Intent I) {

        super.onActivityResult(RC, RQC, I);

        if (RC == 1 && RQC == RESULT_OK && I != null && I.getData() != null) {

            Uri uri = I.getData();

            try {

                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), uri);

                imageView.setImageBitmap(bitmap);

            } catch (IOException e) {

                e.printStackTrace();
            }
        }
    }


    public class getImageFromUrl extends AsyncTask<String,Void,Bitmap>{
        ImageView imgV;

        public getImageFromUrl(ImageView imgV){
            this.imgV = imgV;

        }

        @Override
        protected Bitmap doInBackground(String... url) {
                String urlDisplay = url[0];
                bitmap = null;
                try{

                    InputStream srt = new java.net.URL(urlDisplay).openStream();
                    bitmap = BitmapFactory.decodeStream(srt);

                }catch (Exception e) {
                        e.printStackTrace();
                }
                return bitmap;
        }

        @Override
        protected void onPostExecute(Bitmap bitmap) {
            super.onPostExecute(bitmap);

            imgV.setImageBitmap(bitmap);
        }
    }

    public void ImageUploadToServerFunction(){

        ByteArrayOutputStream byteArrayOutputStreamObject ;

        byteArrayOutputStreamObject = new ByteArrayOutputStream();

        bitmap.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStreamObject);

        byte[] byteArrayVar = byteArrayOutputStreamObject.toByteArray();

        final String ConvertImage = Base64.encodeToString(byteArrayVar, Base64.DEFAULT);

        class AsyncTaskUploadClass extends AsyncTask<Void,Void,String> {

            @Override
            protected void onPreExecute() {

                super.onPreExecute();

                progressDialog = ProgressDialog.show(UpdateProductActivity.this,"Image is Uploading","Please Wait",false,false);
            }

            @Override
            protected void onPostExecute(String string1) {

                super.onPostExecute(string1);

                // Dismiss the progress dialog after done uploading.
                progressDialog.dismiss();

                // Printing uploading success message coming from server on android app.
                Toast.makeText(UpdateProductActivity.this,"Successfully Updated",Toast.LENGTH_LONG).show();

                Intent intent = new Intent(UpdateProductActivity.this,ListInventory.class);
                startActivity(intent);

                // Setting image as transparent after done uploading.

            }

            @Override
            protected String doInBackground(Void... params) {

                ImageProcessClass imageProcessClass = new ImageProcessClass();

                HashMap<String,String> HashMapParams = new HashMap<String,String>();

                Intent intent = getIntent();
                String id = intent.getExtras().getString("id");

                HashMapParams.put(ImageId, id);
                HashMapParams.put(ImageName, GetImageNameEditText);
                HashMapParams.put(ImageDesc, GetImageDescEditText);
                HashMapParams.put(ImageQuantity, GetImageQuantityEditText);
                HashMapParams.put(ImagePrice, GetImagePriceEditText);
                HashMapParams.put(ImagePath, ConvertImage);

                String FinalData = imageProcessClass.ImageHttpRequest(ServerUploadPath, HashMapParams);

                return FinalData;
            }
        }
        AsyncTaskUploadClass AsyncTaskUploadClassOBJ = new AsyncTaskUploadClass();

        AsyncTaskUploadClassOBJ.execute();
    }

    public class ImageProcessClass{

        public String ImageHttpRequest(String requestURL,HashMap<String, String> PData) {

            StringBuilder stringBuilder = new StringBuilder();

            try {

                URL url;
                HttpURLConnection httpURLConnectionObject ;
                OutputStream OutPutStream;
                BufferedWriter bufferedWriterObject ;
                BufferedReader bufferedReaderObject ;
                int RC ;

                url = new URL(requestURL);

                httpURLConnectionObject = (HttpURLConnection) url.openConnection();

                httpURLConnectionObject.setReadTimeout(19000);

                httpURLConnectionObject.setConnectTimeout(19000);

                httpURLConnectionObject.setRequestMethod("POST");

                httpURLConnectionObject.setDoInput(true);

                httpURLConnectionObject.setDoOutput(true);

                OutPutStream = httpURLConnectionObject.getOutputStream();

                bufferedWriterObject = new BufferedWriter(

                        new OutputStreamWriter(OutPutStream, "UTF-8"));

                bufferedWriterObject.write(bufferedWriterDataFN(PData));

                bufferedWriterObject.flush();

                bufferedWriterObject.close();

                OutPutStream.close();

                RC = httpURLConnectionObject.getResponseCode();

                if (RC == HttpsURLConnection.HTTP_OK) {

                    bufferedReaderObject = new BufferedReader(new InputStreamReader(httpURLConnectionObject.getInputStream()));

                    stringBuilder = new StringBuilder();

                    String RC2;

                    while ((RC2 = bufferedReaderObject.readLine()) != null){

                        stringBuilder.append(RC2);
                    }
                }

            } catch (Exception e) {
                e.printStackTrace();
            }
            return stringBuilder.toString();
        }

        private String bufferedWriterDataFN(HashMap<String, String> HashMapParams) throws UnsupportedEncodingException {

            StringBuilder stringBuilderObject;

            stringBuilderObject = new StringBuilder();

            for (Map.Entry<String, String> KEY : HashMapParams.entrySet()) {

                if (check)

                    check = false;
                else
                    stringBuilderObject.append("&");

                stringBuilderObject.append(URLEncoder.encode(KEY.getKey(), "UTF-8"));

                stringBuilderObject.append("=");

                stringBuilderObject.append(URLEncoder.encode(KEY.getValue(), "UTF-8"));
            }

            return stringBuilderObject.toString();
        }

    }
}