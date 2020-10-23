<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;

use Illuminate\Http\Request;

class GCalendarController extends Controller
{ protected $client;
    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('credentials.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
        // izlistavanje napravljenih dogadjaja

        // if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        //     $this->client->setAccessToken($_SESSION['access_token']);
        //     $service = new Google_Service_Calendar($this->client);

        //     $calendarId = 'primary';

        //     $results = $service->events->listEvents($calendarId);
        //     return $results->getItems();

        // } else {
        //     return view('index');
        // }
        return view('index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();
        $startDateTime = $request->input('date');
        $time = $request->input('time');
        $endDateTime = $request->input('date');
        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');

        $vreme=strtotime($time)-60*60*2;

        $vr=date('H:i',$vreme);


        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event(array(
                'summary' => $name,
                'start' => array(
                  'dateTime' => $startDateTime."T".$vr.":00-00:00",
                  'timeZone' => 'Europe/Belgrade',
                ),
                'end' => array(
                  'dateTime' => $startDateTime."T".$vr.":00-00:00",
                  'timeZone' => 'Europe/Belgrade',
                ),
                'sendUpdates'=> $email,
                $optParams = array(
                    'sendNotifications' => true,
                    array('email' => $email),
                ),
                'attendees' => array(
                  array('email' => $email),

                ),
                'conferenceData.entryPoints[].label'=>$phone,
                'reminders' => array(
                  'useDefault' => FALSE,
                  'overrides' => array(
                    array('method' => 'email', 'minutes' => 30),
                    array('method' => 'email', 'minutes' => 15),
                  ),
                ),
              ));

              $calendarId = 'primary';
              $event = $service->events->insert($calendarId, $event);
            //   printf('Event created: %s\n', $event->htmlLink);

            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return redirect('/')->with('message','Event is created');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

       public function oauth()
    {
        session_start();

        $rurl = action('App\Http\Controllers\GCalendarController@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            return redirect()->route('kor.index');
        }
    }
}
