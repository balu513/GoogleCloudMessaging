package com.afbb.balakrishna.gcmsample;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.google.android.gms.gcm.GoogleCloudMessaging;

import java.io.IOException;
import java.util.HashMap;
import java.util.Map;


public class MainActivity extends ActionBarActivity {

    private EditText etEmail, etName, etPhno;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        init();
    }

    private void init() {
        etName = (EditText) findViewById(R.id.et_name);
        etEmail = (EditText) findViewById(R.id.et_email);
        etPhno = (EditText) findViewById(R.id.et_phonenumber);
    }

    public void register(View view) {
        new AsyncTask<String, String, String>() {

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
            }

            @Override
            protected String doInBackground(String... params) {
                GoogleCloudMessaging googleCloudMessaging = GoogleCloudMessaging.getInstance(getApplicationContext());
                try {
                    String registrationId = googleCloudMessaging.register(IConst.SENDER_ID);
                    return registrationId;
                } catch (IOException e) {
                    e.printStackTrace();
                }
                return "not registered";
            }

            @Override
            protected void onPostExecute(String regId) {
                super.onPostExecute(regId);
                registerInOurServer(regId);
                Log.d("MainActivity", "onPostExecute 54 " + regId);
                Toast.makeText(getApplicationContext(), "Registered: " + regId, Toast.LENGTH_SHORT).show();
            }
        }.execute();
    }

    private void registerInOurServer(final String registrationId) {
        final String name = etName.getText().toString();
        final String email = etEmail.getText().toString();
        final String phNo = etPhno.getText().toString();
        StringRequest request = new StringRequest(Request.Method.POST, IConst.URL_REGISTRATION, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("MainActivity", "onResponse 77 " + response);
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("MainActivity", "onErrorResponse 83 " + error.getMessage());
            }

        }) {

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> hashMap = new HashMap();
                hashMap.put(IConst.PARAM_NAME, name);
                hashMap.put(IConst.PARAM_EMAIL, email);
                hashMap.put(IConst.PARAM_PHONE_NUMBER, phNo);
                hashMap.put(IConst.PARAM_REGISTRATION_ID, registrationId);
                return hashMap;
            }
        };
        VolleyRequest.getInstance().getRequestQueue(getApplicationContext()).add(request);

    }


}
