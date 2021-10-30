<?php 

class utility
{
 
    function Str_Quotes($string,$strquote="'") {
        return $strquote. implode($strquote.','.$strquote, explode(',', $string)) .$strquote;
    }
    
    function Chop_Last_Char($string) {
       return  substr($string, 0, -1);
    }
    
    function Chop_First_Char($string) {
        return substr($string, 1);
    }
    
    function Str_ColumnCount($strLine,$dblRow= 1,$strDelimter = ";",$strColDelimter= ","){
        
       $strX=""; 
       $dblcnt=0;
       
       if (trim($strLine) == "") {
           return 0;
       }
       
        $strX = explode($strDelimter,$strLine);
        
        $dblcnt=sizeof($strX);
        
        If (($dblcnt-1) < $dblRow) {
           return 0;
        }
        
        $strX = explode($strColDelimter,$strX[$dblRow - 1]);
        
        return sizeof($strX);
             
    }
    function Str_LineCount($strLine,$strDelimter = ";"){
        
       $strX=""; 
  
       if (trim($strLine) == "") {
           return 0;
       }
       
        $strX = explode($strDelimter,$strLine);
        
        return sizeof($strX)-1;
             
    }

    function search($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->search($subarray, $key, $value));
            }
        }

        return $results;
    }
        
    function Str_Str($strLine,$dblRow,$dblCol,$strDelimter = ";", $strColDelimter=","){
        
        $strX="";
        $dblcnt=0;
        
        $strX = explode($strDelimter,$strLine);
        $dblcnt=sizeof($strX);
        
        If (($dblcnt-1) < $dblRow) {
           return null;
        }
        
        $strY = explode($strColDelimter,$strX[$dblRow - 1]);
                
        If ((sizeof($strY)-1) < ($dblCol - 1)) {
            return null;
        }
        
        If ($dblCol == 0) {
            $dblCol = 1;         
        } 
        
        return $strY[$dblCol - 1];
           
    }
    
    function Str_Block($strValues,$intFromField,$intToField = 1000,$strLineDelimit = ";", $strColDelimit = ",", $strquote = ""){
        
        $intLineCnt=0;
        $intColCnt=0;
        $Str_Block_Out="";
        
        $intLineCnt = $this->Str_LineCount($strValues, $strLineDelimit);
        $intColCnt = $this->Str_ColumnCount($strValues, 1, $strLineDelimit, $strColDelimit);

        If ($intToField > $intColCnt) {
            $intToField = $intColCnt;
        }

        If (($intLineCnt == 0) Or ($intToField > $intColCnt) Or ($intFromField > $intToField)){
            return null;
        }
        
        for ($i = 1; $i <= $intLineCnt; $i++) {
                          
            for ($j = $intFromField; $j <= $intToField; $j++) {

                If ($j <> $intFromField){
                    $Str_Block_Out = $Str_Block_Out . $strColDelimit;
                } 

                $Str_Block_Out = $Str_Block_Out . $strquote . $this->Str_Str($strValues, $i, $j, $strLineDelimit, $strColDelimit) . $strquote;
                
            }
            
            $Str_Block_Out = $Str_Block_Out . $strLineDelimit;
            
       }
        
         return $Str_Block_Out;    
    }

        
        
        

//        If intToField > intColCnt Then intToField = intColCnt
//
//        If intLineCnt = 0 Or intToField > intColCnt Or intFromField > intToField Then Exit Function
//
//        For I = 1 To intLineCnt
//
//            For J = intFromField To intToField
//
//                If J <> intFromField Then Str_Block = Str_Block & strColDelimit
//                Str_Block = Str_Block & strquote & Str_Str(strValues, I, J, strLineDelimit, strColDelimit) & strquote
//
//            Next
//
//            Str_Block = Str_Block & strLineDelimit
//
//        Next
//
//ErrHandler:
//
//        If Err.Number <> 0 Then
//            Str_Block = "-9999; Internal Component Error in Str_Block() " & Err.Number
//            Exit Function
//        End If
//
//    End Function
            
    function SNMP_Clean_Output($string){
        $clean_output = preg_replace("/[A-Za-z]*:[ ]/", "", $string);
        $clean_output = preg_replace("/[(][0-9]*[)][ ]/", "", $clean_output);
        $clean_output = str_replace("Gauge32", "", $clean_output);
        $clean_output = str_replace("Counter32", "", $clean_output);
        $clean_output = str_replace("Hex-", "", $clean_output);
        $clean_output = preg_replace("/[(][0-9][)]/", "", $clean_output);
        return $clean_output;
    }

   
}

 