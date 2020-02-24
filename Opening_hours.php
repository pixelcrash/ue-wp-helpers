function show_opening_hours(){
  
  $date = new DateTime("now", new DateTimeZone('Europe/Vienna') );
  $day = $date->format('w'); 
  $hour = $date->format('G'); 
  $minutes = abs( $date->format('i') ); 
  
  $days_open = array(3, 4, 5);
  $hours_open = array(11, 12, 13, 14, 15, 16, 17);
  
  $lang = pll_current_language();
  if($lang == "de"): 
    
    if(in_array($day, $days_open)):
      if($hour < 11):
        $output = "Wir haben heute ab 11:00 bis 17:00 Uhr geöffnet";
      elseif(in_array($hour, $hours_open)):
        $output = "Wir haben heute noch bis 17:00 Uhr geöffnet";
      elseif($hour >= 17 && in_array($day+1, $days_open)):
        $output = "Wir sind morgen von 11:00 bis 17:00 Uhr wieder für Sie da";
      elseif($hour >= 17 && !in_array($day+1, $days_open)):
        $output = "Wir sind wieder am Mittwoch von 11:00 bis 17:00 Uhr für sie da";
      endif;
    else:
      $output = "Wir sind wieder am Mittwoch von 11:00 bis 17:00 Uhr für sie da";
    endif;
  
  else:
    
    if(in_array($day, $days_open)):
      if($hour < 11):
        $output = "We are open today from 11:00 until 17:00";
      elseif(in_array($hour, $hours_open)):
        $output = "We are still open until 17:00 today";
      elseif($hour >= 17 && in_array($day+1, $days_open)):
        $output = "We are open tomorrow from 11:00 to 17:00";
      elseif($hour >= 17 && !in_array($day+1, $days_open)):
        $output = "We are open again next Wednesday from 11:00 until 17:00";
      endif;
    else:
      $output = "We are open again next Wednesday from 11:00 until 17:00";
    endif;
    
  
  endif;
  
  echo $output;
  // O Sunday 6 Saturday
  
  
}
