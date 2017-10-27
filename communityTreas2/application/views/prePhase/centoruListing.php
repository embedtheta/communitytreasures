<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Index</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<script type="application/javascript">
$( document ).ready(function() {
	
	 $( "#productType" ).change(function() {
		if( $(this).val() == "4" || $(this).val() == "1" ){
			$("#contentUpload").show();
			$("#clothesColour").hide();
			$("#clothesSize").hide();
		}else if( $(this).val() == "6" ){
			$("#clothesColour").show();
			$("#clothesSize").show();
			$("#contentUpload").hide();
		}else{
			$("#contentUpload").hide();
			$("#clothesColour").hide();
			$("#clothesSize").hide();
		}
	 });
});
function addUrls(){
	//alert("sssssssssssss");
	$("#urlSpan").append("<input type=\"text\" name=\"listingUrls[]\"   value=\"\" />");
}
</script>
</head>
<body>
	<!--Header section-->
    	<header class="sq">
   	    <div class="hed_inr">
            <h1><a href="index.html"><img class="logon" src="../images/logo_sq.jpg"></a></h1>
            <h2><!--<a href="#" class="login-manu" >Login</a>--></h2>
          
          <!--<div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">  

            <div class="login-drop">
               <?php if(isset($errorMsg)){?>
               <div class="error-msg"><?php echo $errorMsg;?></div>
               <?php }?>
                	<form action="<?php echo base_url();?>gateway/login" method="post" id="frnd" class="login-form">
                    	<input name="emailID" type="text" placeholder="Email" class="input1" required="">
                        <input name="password" type="password" placeholder="Password" class="input2" required="">
                        <input type="submit" name="logIN" id="logIN" value="Login" class="login-submit"/>
                    </form>
                </div> 
            </div>-->
        </div>
        
        
               

        </header>
	<!--Header section end-->


	<!--body section-->
        <div class="subbmitq">
        	<div class="signup_body_inr">
            	<div class="signup_bdylft"><!--<iframe width="626" height="316" src="//www.youtube.com/embed/Iiqw2Ob1khc" frameborder="0" allowfullscreen></iframe>--></div>
                <div >
                <h5>SIGN UP</h5>
                <!--<h4>Sign Up & Gain Your Financial Freedom</h4>-->
               		<form action="" method="post" id="frnd" enctype="multipart/form-data">
                      <!--<div class="input_section">
                         <label>Product Type</label>
                        <select name="productType" id="productType" >
                        		<option value=0>Please Select</option>
                        		<?php foreach($productTypes as $productType){?>
                        		<option value=<?php echo $productType["productTypeID"]?>><?php echo $productType["productTypeName"]?></option>
                                <?php } ?>
                          </select>
                          <?php echo form_error('productType', '<span class="form_error">', '</span>'); ?>
                      </div>-->
                      <div class="input_section">
                         <label>Name</label>
                         <input type="text" name="listingName" id="listingName"  value="<?php if(isset($listingName)){ echo $listingName;}?>" />
                         <?php echo form_error('listingName', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      <div class="input_section">
                         <label>Address</label>
                         <textarea name="listingAddr" id="listingAddr" ><?php if(isset($listingAddr)){ echo $listingAddr;}?></textarea>
                         <?php echo form_error('listingAddr', '<span class="form_error">', '</span>'); ?>
                         
                       </div>
                       <div class="input_section">
                         <label>Country</label>
                         <select name="listingCountry" id="listingCountry">
                         <option value="United kingdom">United kingdom</option>
                         <option value="USA">USA</option>
                         <option value="Canada">Canada</option>
                          <option value="Gambia">Gambia</option>
                         </select>
                      </div>
                      <!--<div class="input_section">
                         <label>State</label>
                         <select name="listingState" id="listingState">
                         <option value="State A">State A</option>
                         <option value="State B">State B</option>
                         <option value="State C">State C</option>
                         </select>
                       </div>-->
                      <div class="input_section">
                         <label>City </label>
                         <select name="listingCity" id="listingCity">
                         <option value="Aberdeen">Aberdeen ( United kingdom )</option>
                          <option value="Armagh">Armagh ( United kingdom )</option>
                             <option value="Bath">Bath ( United kingdom )</option>
                             <option value="Birmingham">Birmingham ( United kingdom )</option>
                             <option value="Bradford">Bradford ( United kingdom )</option>
                             <option value="Brighton & Hove">Brighton & Hove ( United kingdom )</option>
                             <option value="Bristol">Bristol ( United kingdom )</option>
                             <option value="Bangor">Bangor ( United kingdom )</option>
                             <option value="Belfast">Belfast ( United kingdom )</option>
                             <option value="Cambridge">Cambridge ( United kingdom )</option>
                             <option value="Canterbury">Canterbury ( United kingdom )</option>
                             <option value="Carlisle">Carlisle ( United kingdom )</option>
                             <option value="Chelmsford">Chelmsford ( United kingdom )</option>
                             <option value="Chester">Chester ( United kingdom )</option>
                             <option value="Chichester">Chichester  ( United kingdom )</option>
                             <option value="Coventry">Coventry ( United kingdom )</option>
                             <option value="Cardiff">Cardiff ( United kingdom )</option>
                             <option value="Derby">Derby ( United kingdom )</option>
                             <option value="Durham">Durham ( United kingdom )</option>
                             <option value="Dundee">Dundee ( United kingdom )</option>
                             <option value="Ely">Ely ( United kingdom )</option>
                             <option value="Exeter">Exeter ( United kingdom )</option>
                             <option value="Edinburgh">Edinburgh ( United kingdom )</option>
                             <option value="Glasgow">Glasgow ( United kingdom )</option>
                             <option value="Hereford">Hereford ( United kingdom )</option>
                             <option value="Inverness">Inverness ( United kingdom )</option>
                             <option value="Kingston upon Hull">Kingston upon Hull ( United kingdom )</option>
                             <option value="Lancaster">Lancaster ( United kingdom )</option>
                             <option value="Leeds">Leeds ( United kingdom )</option>
                             <option value="Leicester">Leicester ( United kingdom )</option>
                             <option value="Lichfield">Lichfield ( United kingdom )</option>
                             <option value="Lincoln">Lincoln ( United kingdom )</option>
                             <option value="Liverpool">Liverpool ( United kingdom )</option>
                             <option value="Londonderry">Londonderry ( United kingdom )</option>
                              <option value="Lisburn">Lisburn ( United kingdom )</option>
                             <option value="City of London">City of London ( United kingdom )</option>
                             <option value="Manchester">Manchester ( United kingdom )</option>
                             <option value="Newcastle upon Tyne">Newcastle upon Tyne ( United kingdom )</option>
                             <option value="Norwich">Norwich ( United kingdom )</option>
                             <option value="Nottingham">Nottingham  ( United kingdom )</option>
                             <option value="Newport">Newport ( United kingdom )</option>
                             <option value="Newry">Newry ( United kingdom )</option>
                             <option value="Oxford">Oxford  ( United kingdom )</option>
                             <option value="Peterborough">Peterborough  ( United kingdom )</option>
                             <option value="Plymouth">Plymouth  ( United kingdom )</option>
                             <option value="Portsmouth">Portsmouth  ( United kingdom )</option>
                             <option value="Preston">Preston   ( United kingdom )</option>
                             <option value="Perth">Perth   ( United kingdom )</option>
                             <option value="Ripon">Ripon ( United kingdom )</option>
                             <option value="Salford">Salford ( United kingdom )</option>
                             <option value="Salisbury">Salisbury ( United kingdom )</option>
                             <option value="Sheffield">Sheffield ( United kingdom )</option>
                             <option value="Southampton">Southampton ( United kingdom )</option>
                             <option value="St Albans">St Albans ( United kingdom )</option>
                             <option value="Stoke-on-Trent">Stoke-on-Trent( United kingdom )</option>
                             <option value="Southampton">Southampton ( United kingdom )</option>
                             <option value="Sunderland">Sunderland( United kingdom )</option> 
                             <option value="Stirling">Stirling( United kingdom )</option>
                             <option value="St Asaph">St Asaph( United kingdom )</option>
                             <option value="St David's">St David's( United kingdom )</option>
                              <option value="Swansea">Swansea( United kingdom )</option>
                             <option value="Truro">Truro( United kingdom )</option>
                             <option value="Wakefield">Wakefield( United kingdom )</option>
                             <option value="Wells">Wells( United kingdom )</option>
                             <option value="Westminster">Westminster( United kingdom )</option>
                             <option value="Winchester">Winchester( United kingdom )</option>
                             <option value="Wolverhampton">Wolverhampton( United kingdom )</option>
                             <option value="Worcester">Worcester( United kingdom )</option>
                             <option value="York">York( United kingdom )</option>
                             <option value="Bakau">Bakau(Gambia)</option>
                             <option value="Banjul">Banjul(Gambia)</option>
                             <option value="Bansang">Bansang(Gambia)</option>
                             <option value="Basse Santa Su">Basse Santa Su(Gambia)</option>
                             <option value="Brikama">Brikama(Gambia)</option>
                             <option value="Brufut">Brufut(Gambia)</option>
                             <option value="Farafenni">Farafenni(Gambia)</option>
                             <option value="Janjanbureh">Janjanbureh(Gambia)</option>
                             <option value="Jufureh">Jufureh(Gambia)</option>
                             <option value="Kalagi">Kalagi(Gambia)</option>
                             <option value="Kanilai">Kanilai(Gambia)</option>
                             <option value="Kerewan">Kerewan(Gambia)</option>
                             <option value="Kololi">Kololi(Gambia)</option>
                             <option value="Kuntaur">Kuntaur(Gambia)</option>
                             <option value="Lamin">Lamin(Gambia)</option>
                             <option value="Mansa Konko">Mansa Konko(Gambia)</option>
                             <option value="Nema Kunku">Nema Kunku(Gambia)</option>
                             <option value="Serekunda">Serekunda(Gambia)</option>
                             <option value="Soma">Soma(Gambia)</option>
                             <option value="Sukuta">Sukuta(Gambia)</option>
                             <option value="Tanji">Tanji(Gambia)</option>
                             <option value="Abilene">Abilene(USA)</option>
                                <option value="Akron">Akron(USA)</option>
                                <option value="Albuquerque">Albuquerque(USA)</option>
                                <option value="Alexandria">Alexandria(USA)</option>
                                <option value="Allentown">Allentown(USA)</option>
                                <option value="Amarillo">Amarillo(USA)</option>
                                <option value="Anaheim">Anaheim(USA)</option>
                                <option value="Anchorage">Anchorage(USA)</option>
                                <option value="Ann Arbor">Ann Arbor(USA)</option>
                                <option value="Antioch">Antioch(USA)</option>
                                <option value="Arlington">Arlington(USA)</option>
                                <option value="Arvada">Arvada(USA)</option>
                                <option value="Athens">Athens(USA)</option>
                                <option value="Atlanta">Atlanta(USA)</option>
                                <option value="Augusta">Augusta(USA)</option>
                                <option value="Aurora">Aurora(USA)</option>
                                <option value="Austin">Austin(USA)</option>
                                <option value="Bakersfield">Bakersfield(USA)</option>
                                <option value="Baltimore">Baltimore(USA)</option>
                                <option value="Baton Rouge">Baton Rouge(USA)</option>
                                <option value="Beaumont">Beaumont(USA)</option>
                                <option value="Bellevue">Bellevue(USA)</option>
                                <option value="Berkeley">Berkeley(USA)</option>
                                <option value="Billings">Billings(USA)</option>
                                <option value="Birmingham">Birmingham(USA)</option>
                                <option value="Boise">Boise(USA)</option>
                                <option value="Boston">Boston(USA)</option>
                                <option value="Boulder">Boulder(USA)</option>
                                <option value="Bridgeport">Bridgeport(USA)</option>
                                <option value="Broken Arrow">Broken Arrow(USA)</option>
                                <option value="Brownsville">Brownsville(USA)</option>
                                <option value="Buffalo">Buffalo(USA)</option>
                                <option value="Burbank">Burbank(USA)</option>
                                <option value="Cambridge">Cambridge(USA)</option>
                                <option value="Cape Coral">Cape Coral(USA)</option>
                                <option value="Carlsbad">Carlsbad(USA)</option>
                                <option value="Carrollton">Carrollton(USA)</option>
                                <option value="Cary">Cary(USA)</option>
                                <option value="Cedar Rapids">Cedar Rapids(USA)</option>
                                <option value="Centennial">Centennial(USA)</option>
                                <option value="Chandler">Chandler(USA)</option>
                                <option value="Charleston">Charleston(USA)</option>
                                <option value="Charlotte">Charlotte(USA)</option>
                                <option value="Chattanooga">Chattanooga(USA)</option>
                                <option value="Chesapeake">Chesapeake(USA)</option>
                                <option value="Chicago">Chicago(USA)</option>
                                <option value="Chula Vista">Chula Vista(USA)</option>
                                <option value="Cincinnati">Cincinnati(USA)</option>
                                <option value="Clarksville">Clarksville(USA)</option>
                                <option value="Clearwater">Clearwater(USA)</option>
                                <option value="Cleveland">Cleveland(USA)</option>
                                <option value="College Station">College Station(USA)</option>
                                <option value="Colorado Springs">Colorado Springs(USA)</option>
                                <option value="Columbia">Columbia(USA)</option>
                                <option value="Columbus">Columbus(USA)</option>
                                <option value="Concord">Concord(USA)</option>
                                <option value="Coral Springs">Coral Springs(USA)</option>
                                <option value="Corona">Corona(USA)</option>
                                <option value="Corpus Christi">Corpus Christi(USA)</option>
                                <option value="Costa Mesa">Costa Mesa(USA)</option>
                                <option value="Dallas">Dallas(USA)</option>
                                <option value="Daly City">Daly City(USA)</option>
                                <option value="Davenport">Davenport(USA)</option>
                                <option value="Dayton">Dayton(USA)</option>
                                <option value="Denton">Denton(USA)</option>
                                <option value="Denver">Denver(USA)</option>
                                <option value="Des Moines">Des Moines(USA)</option>
                                <option value="Detroit">Detroit(USA)</option>
                                <option value="Downey">Downey(USA)</option>
                                <option value="Durham">Durham(USA)</option>
                                <option value="Edison">Edison(USA)</option>
                                <option value="El Cajon">El Cajon(USA)</option>
                                <option value="El Monte">El Monte(USA)</option>
                                <option value="El Paso">El Paso(USA)</option>
                                <option value="Elgin">Elgin(USA)</option>
                                <option value="Elizabeth">Elizabeth(USA)</option>
                                <option value="Elk Grove">Elk Grove(USA)</option>
                                <option value="Erie">Erie(USA)</option>
                                <option value="Escondido">El Cajon(USA)</option>
                                <option value="Eugene">Eugene(USA)</option>
                                <option value="Evansville">Evansville(USA)</option>
                                <option value="Everett">Everett(USA)</option>
                                <option value="Fairfield">Fairfield(USA)</option>
                                <option value="Fargo">Fargo(USA)</option>
                                <option value="Fayetteville">Fayetteville(USA)</option>
                                <option value="Fontana">Fontana(USA)</option>
                                <option value="Fort Collins">Fort Collins(USA)</option>
                                <option value="Fort Lauderdale">Fort Lauderdale(USA)</option>
                                <option value="Fort Wayne">Fort Wayne(USA)</option>
                                <option value="Fort Worth">Fort Worth(USA)</option>
                                <option value="Fremont">Fremont(USA)</option>
                                <option value="Fresno">Fresno(USA)</option>
                                <option value="Frisco">Frisco(USA)</option>
                                <option value="Fullerton">Fullerton(USA)</option>
                                <option value="Gainesville">Gainesville(USA)</option>
                                <option value="Garden Grove">Garden Grove(USA)</option>
                                <option value="Garland">Garland(USA)</option>
                                <option value="Gilbert">Gilbert(USA)</option>
                                <option value="Glendale">Glendale(USA)</option>
                                <option value="Grand Prairie">Grand Prairie(USA)</option>
                                <option value="Grand Rapids">Grand Rapids(USA)</option>
                                <option value="Green Bay">Green Bay(USA)</option>
                                <option value="Greensboro">Greensboro(USA)</option>
                                <option value="Gresham">Gresham(USA)</option>
                                <option value="Hampton">Hampton(USA)</option>
                                <option value="Hartford">Hartford(USA)</option>
                                <option value="Hampton">Hampton(USA)</option>
                                <option value="Hayward">Hayward(USA)</option>
                                <option value="Henderson">Henderson(USA)</option>
                                <option value="Hialeah">Hialeah(USA)</option>
                                <option value="High Point">High Point(USA)</option>
                                <option value="Hollywood">Hollywood(USA)</option>
                                <option value="Honolulu">Honolulu(USA)</option>
                                <option value="Houston">Houston(USA)</option>
                                <option value="Huntington Beach">Huntington Beach(USA)</option>
                                <option value="Huntsville">Huntsville(USA)</option>
                                <option value="Independence">Independence(USA)</option>
                                <option value="Indianapolis">Indianapolis(USA)</option>
                                <option value="Inglewood">Inglewood(USA)</option>
                                <option value="Irvine">Irvine(USA)</option>
                                <option value="Irving">Irving(USA)</option>
                                <option value="Jackson">Jackson(USA)</option>
                                <option value="Jacksonville">Jacksonville(USA)</option>
                                <option value="Jersey City">Jersey City(USA)</option>
                                <option value="Joliet">Joliet(USA)</option>
                                <option value="Kansas City">Kansas City(USA)</option>
                                <option value="Kent">Kent(USA)</option>
                                <option value="Killeen">Killeen(USA)</option>
                                <option value="Knoxville">Knoxville(USA)</option>
                                <option value="Lafayette">Lafayette(USA)</option>
                                <option value="Lakeland">Lakeland(USA)</option>
                                <option value="Lakewood">Lakewood(USA)</option>
                                <option value="Lancaster">Lancaster(USA)</option>
                                <option value="Lansing">Lansing(USA)</option>
                                <option value="Laredo">Laredo(USA)</option>
                                <option value="Las Cruces">Las Cruces(USA)</option>
                                <option value="Las Vegas">Las Vegas(USA)</option>
                                <option value="Las Vegas">Lewisville(USA)</option>
                                <option value="Lexington">Lexington(USA)</option>
                                <option value="Lincoln">Lincoln(USA)</option>
                                <option value="Little Rock">Little Rock(USA)</option>
                                <option value="Long Beach">Long Beach(USA)</option>
                                <option value="Los Angeles">Los Angeles(USA)</option>
                                <option value="Louisville">Louisville(USA)</option>
                                <option value="Lowell">Lowell(USA)</option>
                                <option value="Lubbock">Lubbock(USA)</option>
                                <option value="Madison">Madison(USA)</option>
                                <option value="Manchester">Manchester(USA)</option>
                                <option value="McAllen">McAllen(USA)</option>
                                <option value="McKinney">McKinney(USA)</option>
                                <option value="Memphis">Memphis(USA)</option>
                                <option value="Mesa">Mesa(USA)</option>
                                <option value="Mesquite">Mesquite(USA)</option>
                                <option value="Miami">Miami(USA)</option>
                                <option value="Miami Gardens">Miami Gardens(USA)</option>
                                <option value="Midland">Midland(USA)</option>
                                <option value="Milwaukee">Milwaukee(USA)</option>
                                <option value="Minneapolis">Minneapolis(USA)</option>
                                <option value="Miramar">Miramar(USA)</option>
                                <option value="Mobile">Mobile(USA)</option>
                                <option value="Modesto">Modesto(USA)</option>
                                <option value="Montgomery">Montgomery(USA)</option>
                                <option value="Moreno Valley">Moreno Valley(USA)</option>
                                <option value="Murfreesboro">Murfreesboro(USA)</option>
                                <option value="Murrieta">Murrieta(USA)</option>
                                <option value="Naperville">Naperville(USA)</option>
                                <option value="Nashville">Nashville(USA)</option>
                                <option value="New Haven">New Haven(USA)</option>
                                <option value="New Orleans">New Orleans(USA)</option>
                                <option value="New York">New York(USA)</option>
                                <option value="Newark">Newark(USA)</option>
                                <option value="Newport News">Newport News(USA)</option>
                                <option value="Norfolk">Norfolk(USA)</option>
                                <option value="Norman">Norman(USA)</option>
                                <option value="North Charleston">North Charleston(USA)</option>
                                <option value="North Las Vegas">North Las Vegas(USA)</option>
                                <option value="Norwalk">Norwalk(USA)</option>
                                <option value="Oakland">Oakland(USA)</option>
                                <option value="Oceanside">Oceanside(USA)</option>
                                <option value="Odessa">Odessa(USA)</option>
                                <option value="Oklahoma City">Oklahoma City(USA)</option>
                                <option value="Olathe">Olathe(USA)</option>
                                <option value="Omaha">Omaha(USA)</option>
                                <option value="Ontario">Ontario(USA)</option>
                                <option value="Orange">Orange(USA)</option>
                                <option value="Orlando">Orlando(USA)</option>
                                <option value="Overland Park">Overland Park(USA)</option>
                                <option value="Oxnard">Oxnard(USA)</option>
                                <option value="Palm Bay">Palm Bay(USA)</option>
                                <option value="Palmdale">Palmdale(USA)</option>
                                <option value="Pasadena">Pasadena(USA)</option>
                                <option value="Pasadena">Pasadena(USA)</option>
                                <option value="Paterson">Paterson(USA)</option>
                                <option value="Pearland">Pearland(USA)</option>
                                <option value="Pembroke Pines">Pembroke Pines(USA)</option>
                                <option value="Peoria">Peoria(USA)</option>
                                <option value="Philadelphia">Philadelphia(USA)</option>
                                <option value="Phoenix">Phoenix(USA)</option>
                                <option value="Pittsburgh">Pittsburgh(USA)</option>
                                <option value="Plano">Plano(USA)</option>
                                <option value="Pomona">Pomona(USA)</option>
                                <option value="Pompano Beach">Pompano Beach(USA)</option>
                                <option value="Port St. Lucie">Port St. Lucie(USA)</option>
                                <option value="Portland">Portland(USA)</option>
                                <option value="Providence">Providence(USA)</option>
                                <option value="Provo">Provo(USA)</option>
                                <option value="Pueblo">Pueblo(USA)</option>
                                <option value="Raleigh">Raleigh(USA)</option>
                                <option value="Rancho Cucamonga">Rancho Cucamonga(USA)</option>
                                <option value="Reno">Reno(USA)</option>
                                <option value="Rialto">Rialto(USA)</option>
                                <option value="Richardson">Richardson(USA)</option>
                                <option value="Richmond">Richmond(USA)</option>
                                <option value="Riverside">Riverside(USA)</option>
                                <option value="Rochester">Rochester(USA)</option>
                                <option value="Rockford">Rockford(USA)</option>
                                <option value="Roseville">Roseville(USA)</option>
                                <option value="Round Rock">Round Rock(USA)</option>
                                <option value="Sacramento">Sacramento(USA)</option>
                                <option value="Saint Paul">Saint Paul(USA)</option>
                                <option value="Salem">Salem(USA)</option>
                                <option value="Salinas">Salinas(USA)</option>
                                <option value="Salt Lake City">Salt Lake City(USA)</option>
                                <option value="San Antonio">San Antonio(USA)</option>
                                <option value="San Bernardino">San Bernardino(USA)</option>
                                <option value="San Diego">San Diego(USA)</option>
                                <option value="San Francisco">San Francisco(USA)</option>
                                <option value="San Jose">San Jose(USA)</option>
                                <option value="San Mateo">San Mateo(USA)</option>
                                <option value="Santa Ana">Santa Ana(USA)</option>
                                <option value="Santa Clara">Santa Clara(USA)</option>
                                <option value="Santa Clarita">Santa Clarita(USA)</option>
                                <option value="Santa Maria">Santa Maria(USA)</option>
                                <option value="Santa Rosa">Santa Rosa(USA)</option>
                                <option value="Savannah">Savannah(USA)</option>
                                <option value="Scottsdale">Scottsdale(USA)</option>
                                <option value="Seattle">Seattle(USA)</option>
                                <option value="Shreveport">Shreveport(USA)</option>
                                <option value="Simi Valley">Simi Valley(USA)</option>
                                <option value="Sioux Falls">Sioux Falls(USA)</option>
                                <option value="South Bend">South Bend(USA)</option>
                                <option value="Spokane">Spokane(USA)</option>
                                <option value="Springfield">Springfield(USA)</option>
                                <option value="Springfield">Springfield(USA)</option>
                                <option value="Springfield">Springfield(USA)</option>
                                <option value="St. Louis">St. Louis(USA)</option>
                                <option value="Springfield">Springfield(USA)</option>
                                <option value="St. Petersburg">St. Petersburg(USA)</option>
                                <option value="Stamford">Stamford(USA)</option>
                                <option value="Sterling Heights">Sterling Heights(USA)</option>
                                <option value="Stockton">Stockton(USA)</option>
                                <option value="Sunnyvale">Sunnyvale(USA)</option>
                                <option value="Surprise">Surprise(USA)</option>
                                <option value="Syracuse">Syracuse(USA)</option>
                                <option value="Tacoma">Tacoma(USA)</option>
                                <option value="Tallahassee">Tallahassee(USA)</option>
                                <option value="Tampa">Tampa(USA)</option>
                                <option value="Temecula">Temecula(USA)</option>
                                <option value="Tempe">Tempe(USA)</option>
                                <option value="Thornton">Thornton(USA)</option>
                                <option value="Tempe">Tempe(USA)</option>
                                <option value="Thousand Oaks">Thousand Oaks(USA)</option>
                                <option value="Toledo">Toledo(USA)</option>
                                <option value="Topeka">Topeka(USA)</option>
                                <option value="Torrance">Torrance(USA)</option>
                                <option value="Tucson">Tucson(USA)</option>
                                <option value="Tulsa">Tulsa(USA)</option>
                                <option value="Vallejo">Vallejo(USA)</option>
                                <option value="Vancouver">Vancouver(USA)</option>
                                <option value="Ventura">Ventura(USA)</option>
                                <option value="Victorville">Victorville(USA)</option>
                                <option value="Virginia Beach">Virginia Beach(USA)</option>
                                <option value="Visalia">Visalia(USA)</option>
                                <option value="Waco">Waco(USA)</option>
                                <option value="Warren">Warren(USA)</option>
                                <option value="Washington">Washington(USA)</option>
                                <option value="Waterbury">Waterbury(USA)</option>
                                <option value="West Covina">West Covina(USA)</option>
                                <option value="West Palm Beach">West Palm Beach(USA)</option>
                                <option value="West Valley City">West Valley City(USA)</option>
                                <option value="Westminster">Westminster(USA)</option>
                                <option value="Wichita">Wichita(USA)</option>
                                <option value="Wichita Falls">Wichita Falls(USA)</option>
                                <option value="Wilmington">Wilmington(USA)</option>
                                <option value="Winston–Salem">Winston–Salem(USA)</option>
                                <option value="Worcester">Worcester(USA)</option>
                                <option value="Yonkers">Yonkers(USA)</option>
                         </select>
                         
                      </div>
                       <div class="input_section">
                         <label>Number</label>
                         <input type="text" name="listingNo" id="listingNo"  value="<?php if(isset($listingNo)){ echo $listingNo;}?>" />
                         <?php echo form_error('listingNo', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                       <div class="input_section">
                         <label>Description</label>
                         <textarea name="listingDesc" id="listingDesc" ><?php if(isset($listingDesc)){ echo $listingDesc;}?></textarea>
                         <?php echo form_error('listingDesc', '<span class="form_error">', '</span>'); ?>
                         
                       </div>
                       <div class="input_section">
                         <label>Website</label>
                         <input type="text" name="listingWebsite" id="listingWebsite"  value="<?php if(isset($listingName)){ echo $listingName;}?>" />
                         <?php echo form_error('listingName', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      <div class="input_section">
                         <label>Youtube Url</label>
                         <input type="text" name="listingUrl" id="listingUrl"  value="<?php if(isset($listingUrl)){ echo $listingUrl;}?>" />
                         <?php echo form_error('listingUrl', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      
                       <!--<div class="input_section">
                         <label>Product Cost</label>
                         <input type="text" name="productPrice" id="productPrice"  value="<?php if(isset($productPrice)){ echo $productPrice;}?>" />
                         <?php echo form_error('productPrice', '<span class="form_error">', '</span>'); ?>
                        <input type="text" name="cellno" id="cellno" value="" >
                         </div>-->
                       <div class="input_section">
                         <label> Image</label>
                         <input type="file" name="image" id="image"  />(jpg|gif|png only supported)
                         <?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                         <!--<input type="text" name="emailAddr" id="emailAddr"  value="">-->
                       </div>
                       <div class="input_section">
                         <label> Put afroo links to view this members</label>
                         <span id="urlSpan">
                         <input type="text" name="listingUrls[]"   value="" />
                         </span>
                         <span onClick="addUrls()"><a href="javascript:void(0)">Add More Urls</a></span>
                       </div>
                       <!--<div class="input_section">
                         <label>Upload MP3/Videos</label>
                         <input type="file" name="image1" id="image1"  />
                         <?php echo form_error('image1', '<span class="form_error">', '</span>'); ?>
                         <input name="city" id="city" type="text" >
                       </div>-->
                       <!--<div class="input_section" style="display:none" id="clothesColour">
                         <label>Clothes Colour</label>
                            <input type="checkbox" name="colour[]" value="Red"/><span style="color:#FFFFFF">Red</span> 
                            <input type="checkbox" name="colour[]" value="Black"/><span style="color:#FFFFFF">Black</span>
                            <input type="checkbox" name="colour[]" value="Green"/><span style="color:#FFFFFF">Green</span>
                            <input type="checkbox" name="colour[]" value="Yellow"/><span style="color:#FFFFFF">Yellow</span>
                         
                       </div>
                       <div class="input_section" style="display:none" id="clothesSize">
                         <label>Clothes Size</label>
                            <input type="checkbox" name="size[]" value="36"/><span style="color:#FFFFFF">36 </span>
                            <input type="checkbox" name="size[]" value="38"/><span style="color:#FFFFFF">38</span>
                            <input type="checkbox" name="size[]" value="40"/><span style="color:#FFFFFF">40</span>
                            <input type="checkbox" name="size[]" value="42"/><span style="color:#FFFFFF">42</span>
                         
                       </div>
                       <div class="input_section" >
                         <label>Secondary Image</label>
                            <input type="file" name="SecondaryImg[]" id="image"  /></br>
      						<input type="file" name="SecondaryImg[]" id="image"  /></br>
                            <input type="file" name="SecondaryImg[]" id="image" /></br>
                         
                       </div>
                       <div class="input_section" >
                         <label>Status</label>
                           <input type="radio" name="productStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="productStatus" value="0" class="input-status" />Inactive
                        
                       </div>-->
                       
                       <div class="input_section">
                         <input type="submit" name="submit" id="submit" value="save"  />
                       </div>
                     </form>
                </div><div class="clear"></div>
            </div>
            
            
        </div>
	<!--body section end-->
    
    
    
    


	<!--footer section-->
        <footer>
        		<p>© 2014 Morpheus Society | Website by Celestial Technologies. All Rights Reserved</p>
        </footer>
	<!--footer section end-->
    </div>
    
    
                
    
    
</body>
</html>