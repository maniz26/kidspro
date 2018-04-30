<?php
namespace Nepbaycloudservices\Plugins\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use DateTimeZone;
use DateTime;
use DateInterval;

class DomflightApi {

    public static $endpoint;
    public static $username;
    public static $password;
    public static $agentID;            

    /**
     * Get API Credentila
     * 
     * @return Void
     */
    public static function setCredentials() {
        
        self::$endpoint = config('domflight.dm_end_point');
        self::$username = config('domflight.dm_username');
        self::$password = config('domflight.dm_password');
        self::$agentID = config('domflight.dm_agent_id');          

    }

    /**
     * Get Sectors List
     * 
     * @return Array()
     */
    public static function getSectors(){
        self::setCredentials();

        $CREDENTIALS = self::$username . ':' . self::$password;
        $message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:book="http://booking.us.org/">
                    <soapenv:Header/>
                        <soapenv:Body>
                            <book:SectorCode>
                                <strUserId>'.self::$agentID.'</strUserId>
                            </book:SectorCode>
                        </soapenv:Body>
                    </soapenv:Envelope>';                   

        $file = "Domflight/xml/sectorCodeReq.xml";

        prettyPrint($message, $file);
        $auth = base64_encode("$CREDENTIALS");
        $soap_do = curl_init(self::$endpoint);
        //$soap_do = curl_init('http://usbooking.org/us/UnitedSolutions?wsdl');
        
        $header = array(
            "Content-Type: text/xml;charset=UTF-8",
            "Accept: gzip,deflate",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: \"\"",
            "Content-length: " . strlen($message),
        );

        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);

        

        $return = curl_exec($soap_do);
       /* dump( $return);
        exit;*/
        $file = "Domflight/xml/sectorCodeRsp.xml";
        $content = prettyPrint($return, $file);
        $json = xmlToJson($content);
        return $json;
    
    }

    /**
     * Check Flight Availability
     * 
     * @param string $sessionID
     */ 
    public static function getFlightAvailability($sessionID){
        self::setCredentials();
        
        $CREDENTIALS = trim(self::$username) . ':' . trim(self::$password);
       
        $sessionData = session($sessionID);       
        $searchParameters = $sessionData['searcQueries'];
        $trip = $searchParameters['trip']==1 ? 'O':'R';
        $origin = $searchParameters['origin'];
        $destination = $searchParameters['destination'];
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$searchParameters['depatureDate'])) {
           $depatureDate = Carbon::parse($searchParameters['date'])->format('d-M-Y');
        } else {
           $dateParts = explode('-', $searchParameters['depatureDate']);
           $depatureDate = Carbon::parse($dateParts[0])->format('d-M-Y');
        }        
        
        if(isset($dateParts[1])){
            
            $returnDate = Carbon::parse($dateParts[1])->format('d-M-Y');  
        }else{

            $returnDate = '';
        }
        
            
        $adults = $searchParameters['adults'];
        $children = $searchParameters['children'];        
        $nationality = $searchParameters['nationality'];

        $message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:book="http://booking.us.org/">
                   <soapenv:Header/>
                   <soapenv:Body>
                      <book:FlightAvailability>                        
                         <strUserId>'.self::$username.'</strUserId>
                        <strPassword>'.self::$password.'</strPassword>
                        <strAgencyId>'.self::$agentID.'</strAgencyId>
                         <strSectorFrom>'.$origin.'</strSectorFrom>
                         <strSectorTo>'.$destination.'</strSectorTo>
                         <strFlightDate>'.$depatureDate.'</strFlightDate>
                         <strReturnDate>'.$returnDate.'</strReturnDate>
                         <strTripType>'.$trip.'</strTripType>
                         <strNationality>'. $nationality.'</strNationality>
                         <intAdult>'.$adults.'</intAdult>
                         <intChild>'.$children.'</intChild>
                      </book:FlightAvailability>
                   </soapenv:Body>
                </soapenv:Envelope>';   

        $file = "Domflight/xml/FlightAvailabilityReq.xml";
        
        prettyPrint($message, $file);
        $auth = base64_encode("$CREDENTIALS");
        $soap_do = curl_init(self::$endpoint);
        $header = array(
            "Content-Type: text/xml;charset=UTF-8",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Content-length: " . strlen($message),
        );

        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);      
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_POST, true);         
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
        
        $return = curl_exec($soap_do);
        
        $file = "Domflight/xml/FlightAvailabilityRsp.xml";

        $content = prettyPrint($return, $file);
        $json = xmlToJson($content);
        return $json;
    }


    /**
     * Reserve Flight
     * 
     * @param string $sessionID
     */ 
    public static function reservation($sessionID){

       /* $file = "Domflight/xml/ReservationRsp.xml";
        $content = file_get_contents($file);
        $json = xmlToJson($content );
        return $json;
*/
        self::setCredentials();
        $CREDENTIALS = trim(self::$username) . ':' . trim(self::$password);
       
        $sessionData = session($sessionID);       
      
        $searchParameters = $sessionData['searcQueries'];  
        if($searchParameters['trip']==1){
          $requestFlightData['outbound'] =  json_decode($sessionData['itinerary']['outbounddetails'], true);
          $requestFlightData['inbound'] = array();
        } else{
          $requestFlightData['outbound'] =  json_decode($sessionData['itinerary']['outbounddetails'], true);
          $requestFlightData['inbound'] =  json_decode($sessionData['itinerary']['inbounddetails'], true);
        }     
        

        $strFlightId= $requestFlightData['outbound']['FlightId'];
        $strReturnFlightId = isset($requestFlightData['inbound']['FlightId'])? $requestFlightData['inbound']['FlightId'] :null;

        $message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:book="http://booking.us.org/">
                   <soapenv:Header/>
                   <soapenv:Body>
                      <book:Reservation>                        
                         <strFlightId>'. $strFlightId.'</strFlightId>
                         <strReturnFlightId>'.$strReturnFlightId.'</strReturnFlightId>                       
                      </book:Reservation>
                   </soapenv:Body>
                </soapenv:Envelope>';  
        
        $file = "Domflight/xml/ReservationReq.xml";
        
        prettyPrint($message, $file);

       

        $auth = base64_encode("$CREDENTIALS");
        $soap_do = curl_init(self::$endpoint);
        $header = array(
            "Content-Type: text/xml;charset=UTF-8",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Content-length: " . strlen($message),
        );
        

        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);      
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_POST, true);         
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
        curl_setopt($soap_do, CURLOPT_USERPWD, $CREDENTIALS );
        
        $return = curl_exec($soap_do);

        $file = "Domflight/xml/ReservationRsp.xml";
 
        $content = prettyPrint($return, $file);      
        $json = xmlToJson($content);
        return $json;

    }

    /**
     * Issue Ticket
     * 
     * @param array $detalis
     */ 
    public static function issueTicket($details){
      
       /* $file = "Domflight/xml/IssueTicketRsp.xml";
        $content = file_get_contents($file);
        $json = xmlToJson($content );
        return $json;
*/

        self::setCredentials();

        $CREDENTIALS = trim(self::$username) . ':' . trim(self::$password);

        $reservation =  json_decode($details['orderDetails']->order_booking_details, true);
       

        $bookingDetails =  json_decode($details['orderDetails']->order_passanger_details, true);
        //dump($bookingDetails);
        /*if(isset($create_reservation['SBody']['ns2ReservationResponse']['return']['ReservationDetail'])){
            $reservation = $create_reservation['SBody']['ns2ReservationResponse']['return']['ReservationDetail'];
        }else{
            $msg = $create_reservation['SBody']['ns2ReservationResponse']['return']['Error'];
            session(['apiErrorMessge' => $msg]);
            return 'error';
        }*/
        

        $strReturnFlightId =null;
        if( isAssoc($reservation['PNRDetail']) ){
            $strFlightId = $reservation['PNRDetail']['FlightId'];
        }else{
            $strFlightId =$reservation['PNRDetail'][0]['FlightId'];
            $strReturnFlightId = $reservation['PNRDetail'][1]['FlightId'];
            
        }
       
        
        $strContactName = $bookingDetails['cardhname'];        
        $strContactEmail = $bookingDetails['email'];
        $strContactMobile = $bookingDetails['countrycode'].$bookingDetails['areacode'].$bookingDetails['contactno'];
        preg_match('!\d+!', $strContactMobile, $matches);
       
        if( $matches){
          $strContactMobile= $matches[0];
        }
         
        $passanger_remarks = !empty( $bookingDetails['remarks']) ?  strip_tags($bookingDetails['remarks']): 'No Remarks';

        $pessangers = '';
        foreach($bookingDetails['adutlTitle'] as $index=> $title){
            $gender =  $title == 'Mr'? 'M':'F';
            $fname = $bookingDetails['adutlFname'][$index];
            $lname = $bookingDetails['adutlLname'][$index];
            $nationality = $bookingDetails['adutlCountry'][$index];

            
            $pessangers .='<Passenger>
                            <PaxType>ADULT</PaxType>
                            <Title>'.$title.'</Title>
                            <Gender>'.$gender.'</Gender>
                            <FirstName>'.$fname.'</FirstName>
                            <LastName>'.$lname.'</LastName>
                            <Nationality>'.$nationality.'</Nationality>
                            <PaxRemarks>'.$passanger_remarks.'</PaxRemarks>
                            </Passenger>';      

        }
        if( isset($bookingDetails['childTitle']) && is_array($bookingDetails['childTitle'])) {
            
            foreach($bookingDetails['childTitle'] as $index=> $title){               
                $gender =  $title == 'Mstr.'? 'M':'F';
                $fname = $bookingDetails['childFname'][$index];
                $lname = $bookingDetails['childLname'][$index];
                $nationality = $bookingDetails['childCountry'][$index];
                
                $pessangers .='<Passenger>
                                <PaxType>CHILD</PaxType>
                                <Title>'.$title.'</Title>
                                <Gender>'.$gender.'</Gender>
                                <FirstName>'.$fname.'</FirstName>
                                <LastName>'.$lname.'</LastName>                               
                                <PaxRemarks>No Remarks</PaxRemarks>
                                </Passenger>';      
                

            }
        }

        $message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:book="http://booking.us.org/">
                   <soapenv:Header/>
                   <soapenv:Body>
                      <book:IssueTicket>
                         <strFlightId>'.$strFlightId.'</strFlightId>
                         <strReturnFlightId>'.$strReturnFlightId.'</strReturnFlightId>
                         <strContactName>'.$strContactName.'</strContactName>
                         <strContactEmail>'.$strContactEmail.'</strContactEmail>
                         <strContactMobile>'.$strContactMobile.'</strContactMobile>
                         <strPassengerDetail><![CDATA[<?xml version="1.0"?><PassengerDetail>
                        '.$pessangers.'
                        </PassengerDetail>]]></strPassengerDetail>                        
                      </book:IssueTicket>
                   </soapenv:Body>
                </soapenv:Envelope>'; 
       
        $file = "Domflight/xml/IssueTicketReq.xml";
        
        $content = prettyPrint($message, $file);
        $json = xmlToJson($content);
        //return $json;
        

        $auth = base64_encode("$CREDENTIALS");
        $soap_do = curl_init(self::$endpoint);
        $header = array(
            "Content-Type: text/xml;charset=UTF-8",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Content-length: " . strlen($message),
        );

        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);      
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_POST, true);         
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
        curl_setopt($soap_do, CURLOPT_USERPWD, $CREDENTIALS );
        
        $return = curl_exec($soap_do);
        
        $file = "Domflight/xml/IssueTicketRsp.xml";

        $content = prettyPrint($return, $file);
        $json = xmlToJson($content);
        return $json;

    }

    /**
     * Canecel Booking
     * 
     * @param string $params
     */ 
    public static function DomesticCancel($params) {
        
        $CREDENTIALS = trim(self::$username) . ':' . trim(self::$password);
        $airCreateReservationData = $params['airCreateReservationData']['SBody']['ns2ReservationResponse']['return']['ReservationDetail']['PNRDetail'];
       
        foreach ($airCreateReservationData as $key => $val) {
            $str = '<strPnrNo>'.$val['PNRNO'].'</strPnrNo>
            <strTicketNo>'.$params['Ticket'][$key]['TicketNo'].'</strTicketNo>
            <strAirlineId>'.$val['AirlineID'].'</strAirlineId>';
        }

        $message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:book="http://booking.us.org/">
                   <soapenv:Header/><soapenv:Body>
                      <book:CancelReservation>
                        <strUserId>'.self::$username.'</strUserId>
                        <strPassword>'.self::$password.'</strPassword>
                        <strAgencyId>'.self::$agentID.'</strAgencyId>
                        '.$str.'   
                      </book:CancelReservation>
                   </soapenv:Body> </soapenv:Envelope>
                ';

        $file = "Domflight/xml/DomesticCancelReq.xml";
        prettyPrint($message, $file);

        $auth = base64_encode("$CREDENTIALS");
        $soap_do = curl_init(self::$endpoint);
        $header = array(
            "Content-Type: text/xml;charset=UTF-8",
            "Accept: gzip,deflate",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: \"\"",
            "Authorization: Basic $auth",
            "Content-length: " . strlen($message),
        );

        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($soap_do);
      

        $file = "Domflight/xml/DomesticCancelRsp.xml";
        $content = prettyPrint($return, $file);
        $json = xmlToJson($content);
        return $json;
    }

    public static function  getTimeDiff($dtime,$atime){
        

         $nextDay= $dtime> $atime? 1: 0;
         $dep = str_replace('.', ':', $dtime);
         $arr = str_replace('.', ':', $atime);
         
         $dep =explode(':',$dep);
         $arr =explode(':',$arr);
         
         $diff=abs( mktime( (int)$dep[0], (int)$dep[1], 0, date('n'),date('j'),date('y') ) - mktime( (int)$arr[0], (int)$arr[1],0, date('n'), date('j') + $nextDay, date('y') ) );
         $hours=floor($diff/(60*60));
         $mins=floor(($diff-($hours*60*60))/(60));
         $secs=floor(($diff-(($hours*60*60)+($mins*60))));
         if(strlen($hours)<2){$hours="0".$hours;}
         if(strlen($mins)<2){$mins="0".$mins;}
         if(strlen($secs)<2){$secs="0".$secs;}
         return  $hours.'h '.$mins.'m '.$secs .'s';
         //return  $hours.':'.$mins.':'.$secs;
    }

   public static function getCountries(){
      return $countries= array(
        "AF"=>'Afghan',
        "AL"=>'Albanian',
        "US"=>'American',
        "AS"=>'American Samoan',
        "AD"=>'Andorran',
        "AO"=>'Angolan',
        "AI"=>'Anguillan',
        "AG"=>'Antiguan, Barbudan',
        "AR"=>'Argentine',
        "AM"=>'Armenian',
        "AW"=>'Aruban',
        "AU"=>'Australian',
        "AT"=>'Austrian',
        "AZ"=>'Azerbaijani',
        "BS"=>'Bahamian',
        "BH"=>'Bahraini',
        "BD"=>'Bangladesh',
        "BB"=>"Barbadian'/Bajan",
        "LS"=>'Basotho',
        "BY"=>'Belarusian',
        "BE"=>'Belgian',
        "BZ"=>'Belizean',
        "BJ"=>'Beninese',
        "BM"=>'Bermudian',
        "BT"=>'Bhutanese',
        "BO"=>'Bolivian',
        "BA"=>'Bosnian, Herzegovinian',
        "BR"=>'Brazilian',
        "GB"=>'British',
        "VG"=>'British Virgin Islander',
        "BN"=>'Bruneian',
        "BG"=>'Bulgarian',
        "BF"=>'Burkinabe',
        "BI"=>'Burundi',
        "KH"=>'Cambodian',
        "CM"=>'Cameroonian',
        "CA"=>'Canadian',
        "CV"=>'Cape Verdean',
        "KY"=>'Caymanian',
        "CF"=>'Central African',
        "TD"=>'Chadian',
        "CL"=>'Chilean',
        "CN"=>'Chinese',
        "CX"=>'Christmas Island',
        "CC"=>'Cocos Islander',
        "CO"=>'Colombian',
        "KM"=>'Comoran',
        "CG"=>'Congolese or Congo',
        "CK"=>'Cook Islander',
        "CR"=>'Costa Rican',
        "HR"=>'Croatian',
        "CU"=>'Cuban',
        "CY"=>'Cypriot',
        "CZ"=>'Czech',
        "DK"=>'Danish',
        "DJ"=>'Djiboutian',
        "DO"=>'Dominican',
        "NL"=>'Dutch',
        "EC"=>'Ecuadorian',
        "EG"=>'Egyptian',
        "AE"=>'Emirian',
        "GQ"=>'Equatorial Guinean',
        "ER"=>'Eritrean',
        "EE"=>'Estonian',
        "ET"=>'Ethiopian',
        "FK"=>'Falkland Island',
        "FO"=>'Faroese',
        "FJ"=>'Fijian',
        "FI"=>'Finnish',
        "FR"=>'French',
        "GF"=>'French Guianese',
        "PF"=>'French Polynesian',
        "GA"=>'Gabonese',
        "GM"=>'Gambian',
        "GE"=>'Georgian',
        "DE"=>'German',
        "GH"=>'Ghanaian',
        "GI"=>'Gibraltar',
        "GR"=>'Greek',
        "GL"=>'Greenlandic',
        "GD"=>'Grenadian',
        "GP"=>'Guadeloupe',
        "GU"=>'Guamanian',
        "GT"=>'Guatemalan',
        "GW"=>'Guinean',
        "GN"=>'Guinean',
        "GY"=>'Guyanese',
        "HT"=>'Haitian',
        "HN"=>'Honduran',
        "HU"=>'Hungarian',
        "IS"=>'Icelandic',
        "KI"=>'I-Kiribati',
        "IN"=>'Indian',
        "ID"=>'Indonesian',
        "IR"=>'Iranian',
        "IQ"=>'Iraqi',
        "IE"=>'Irish',
        "IL"=>'Israeli',
        "IT"=>'Italian',
        "JM"=>'Jamaican',
        "JP"=>'Japanese',
        "JO"=>'Jordanian',
        "KZ"=>'Kazakhstani',
        "KE"=>'Kenyan',
        "KN"=>'Kittitian, Nevisian',
        "KP"=>'Korean',
        "KW"=>'Kuwaiti',
        "KG"=>'Kyrgyzstani',
        "LA"=>'Lao or Laotian',
        "LV"=>'Latvian',
        "LB"=>'Lebanese',
        "LR"=>'Liberian',
        "LY"=>'Libyan',
        "LI"=>'Liechtenstein',
        "LT"=>'Lithuanian',
        "LU"=>'Luxembourg',
        "YT"=>'Mahoran',
        "MG"=>'Malagasy',
        "MW"=>'Malawian',
        "MY"=>'Malaysian',
        "MV"=>'Maldivian',
        "ML"=>'Malian',
        "MT"=>'maltese',
        "MH"=>'Marshallese',
        "MQ"=>'Martiniquais',
        "MR"=>'Mauritanian',
        "MU"=>'Mauritian',
        "MX"=>'Mexican',
        "MD"=>'Moldovan',
        "MC"=>'Monegasque or Monacan',
        "MN"=>'Mongolian',
        "MS"=>'Montserratian',
        "MA"=>'Moroccan',
        "BW"=>'Motswana/Batswana',
        "MZ"=>'Mozambican',
        "NA"=>'Namibian',
        "NR"=>'Nauruan',
        "NP"=>'Nepalese',
        "AN"=>'Netherlands Antillean',
        "NC"=>'New Caledonian',
        "NZ"=>'New Zealand',
        "NI"=>'Nicaraguan',
        "NG"=>'Nigerian',
        "NE"=>'Nigerien',
        "NU"=>'Niuean',
        "VU"=>'Ni-Vanuatu',
        "NF"=>'Norfolk Islander(s)',
        "NO"=>'Norwegian',
        "O"=>'Others',
        "OM"=>'Omani',
        "PK"=>'Pakistani',
        "PW"=>'Palauan',
        "PA"=>'Panamanian',
        "PG"=>'Papua New Guinean',
        "PY"=>'Paraguayan',
        "PE"=>'Peruvian',
        "PH"=>'Philippine',
        "PL"=>'Polish',
        "PT"=>'Portuguese',
        "PR"=>'Puerto Rican',
        "QA"=>'Qatari',
        "RE"=>'Reunionese',
        "RO"=>'Romanian',
        "RU"=>'Russian',
        "RW"=>'Rwandan',
        "EH"=>'Sahrawian, Sahraouian',
        "SH"=>'Saint Helenian',
        "LC"=>'Saint Lucian',
        "VC"=>'Saint Vincentian',
        "SV"=>'Salvadoran',
        "SM"=>'Sammarinese',
        "WS"=>'Samoan',
        "ST"=>'Sao Tomean',
        "SA"=>'Saudi or Saudi Arabian',
        "SN"=>'Senegalese',
        "SC"=>'Seychelles',
        "SL"=>'Sierra Leonean',
        "SG"=>'Singapore',
        "SK"=>'Slovak',
        "SI"=>'Slovenian',
        "SB"=>'Solomon Islander',
        "SO"=>'Somali',
        "ZA"=>'South African',
        "ES"=>'Spanish',
        "LK"=>'Sri Lankan',
        "SD"=>'Sudanese',
        "SR"=>'Surinamese',
        "SZ"=>'Swazi',
        "SE"=>'Swedish',
        "CH"=>'Swiss',
        "SY"=>'Syrian',
        "TJ"=>'Tajikistani',
        "TZ"=>'Tanzanian',
        "TH"=>'Thai',
        "TG"=>'Togolese',
        "TK"=>'Tokelauan',
        "TO"=>'Tongan',
        "TT"=>'Trinidadian, Tobagonian',
        "TN"=>'Tunisian',
        "TR"=>'Turkish',
        "TM"=>'Turkmen',
        "TV"=>'Tuvaluan',
        "UG"=>'Ugandan',
        "UA"=>'Ukrainian',
        "UY"=>'Uruguayan',
        "UZ"=>'Uzbekistani',
        "VE"=>'Venezuelan',
        "VN"=>'Vietnamese',
        "VI"=>'Virgin Islander',
        "WF"=>'Wallisian, Futunan',
        "YE"=>'Yemeni',
        "ZM"=>'Zambian',
        "ZW"=>'Zimbabwean');

    }

}