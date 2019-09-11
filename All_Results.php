<?php
session_start();
$PageTitle = 'All Result';
include "init.php";
?>
<!--start Content-->
        
<div class="container">
    <div class="col-md-15"><br />
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Result SCHOOL</h3>
                <h3 class="panel-title">
                    
                </h3><br />
            </div>
            <table class="table table-hover" id="task-table">
                <thead>
<?                      //   عشان عايز اجيب الناجحين ومعاهم مواد = عايز اعرف تنفع دي وﻻ ﻻ
                        
                        // $sql_select   = " SELECT * FROM `First_year` 
                        //             WHERE      `Topic_Math` between 1 and 60 
                        //                     OR `artificial_intelegance` between 1 and 60 
                        //                     OR `biodegradation` between 1 and 60 
                        //                     OR `NetworkEnginering` between 1 and 60 
                        //                     OR `SensorNetwork` between 1 and 60 
                        //                        ";
                        // $sql_Resulet = " SELECT * FROM `First_year` عايز اعرف تنفع دي وﻻ ﻻ
                        //             WHERE 
                        //                 `Topic_Math` > 60 
                        //             OR
                        //                 `artificial_intelegance` > 60 
                        //             OR 
                        //                 `biodegradation` > 60
                        //             OR  
                        //                 `NetworkEnginering` > 60
                        //             OR
                        //                 `SensorNetwork` > 60                                        
                        //                 ( SELECT  * FROM `First_year` Group by `SNum`
                        //                 Having count ( `First_year`) > 2)";                                                  
                        // $query_select = mysqli_query($con,$sql_select) or die(error());
                        // echo $count4   = mysqli_num_rows($query_select);
?>  
                    <tr>
                        <th>#YEARS</th>
                        <th>How Successful</th>
                        <th>How Fallen</th>
                        <th>Net successful</th>
                        <th>Net successful Materials</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>	
                        <th>First Year</th>
                        <td><? echo $first   = Ch_Successful("First_year" , "Total"  , 600 , 499) ;  ?></td>
                        <td><? echo $fallen1 = Ch_Successful("First_year" , "Total" , 1 , 312) ; //  ?></td>
                        <td><? echo $press1  = Ch_Successful("First_year" , "Total" , 300 , 500)
                                             - Ch_Successful("First_year" , "Net_Materials" , 1 , 2 );?></td>
                        <td><? echo $NOT1    = Ch_Successful("First_year" , "Net_Materials" , 1 , 2 ) ;  ?></td>
                    </tr>
                    <tr>
                        <th>Two Year</th>
                        <td><? echo $two     = Ch_Successful("Two_Year" , "Total" , 600 , 999) ;  ?></td>
                        <td><? echo $fallen2 = Ch_Successful("Two_Year" , "Total" , 1 , 599) ; //  ?></td>
                        <td><? echo $press2  = Ch_Successful("Two_Year" , "Total" , 600 , 999 )
                                             - Ch_Successful("Two_Year" , "Net_Materials" , 1 , 2 ) ;  ?></td>
                        <td><? echo $NOT2    = Ch_Successful("Two_Year" , "Net_Materials" , 1 , 2 ) ;  ?></td>
                    <tr>
                        <th>Three Year</th>
                        <td><? echo $three   = Ch_Successful("Three_Year" , "Total" , 600 , 999) ;  ?></td>
                        <td><? echo $fallen3 = Ch_Successful("Three_Year" , "Total" , 1 , 599) ; //  ?></td>
                        <td><? echo $press3  = Ch_Successful("Three_Year" , "Total" , 600 , 999 )
                                             - Ch_Successful("Three_Year" , "Net_Materials" , 1 , 2 );?></td>
                        <td><? echo $NOT3     = Ch_Successful("Three_Year" , "Net_Materials" , 1 , 2 ) ;  ?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <th>
                            <? 
                               echo $Total = $first + $two + $three;  
                            ?>
                        </th>   
                        <th>
                            <? 
                               echo $Total_fallen = $fallen1 + $fallen2 + $fallen3;  
                            ?>
                        </th>
                        <th>
                            <? 
                               echo $Total_Net = $press1 + $press2 + $press3 ;  
                            ?>
                        </th>
                        <th>
                            <? 
                               echo $Total_Not_Net = $NOT1 + $NOT2 + $NOT3 ;  
                            ?>
                        </th>   
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Start Table 2 -->
    <div class="col-md-15"><br />
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Result Student Degress</h3>
            </div>
            <table class="table table-hover" id="task-table">
                <thead>
                <tr>
                        <th>#YEARS</th>
                        <th>Excellence</th>
                        <th>very good</th>
                        <th>Good</th>
                        <th>Acceptable</th>
                    </tr>
                </thead>
                <tbody>
<?
                    ?>
                    <tr>	
                        <th>First Year</th>
                        <td><? echo $first   = Ch_Successful("First_year" , "Total" , 425, 499  ) ;       ?></td>
                        <td><? echo $fallen1 = Ch_Successful("First_year" , "Total" , 376 , 425 ) ;       ?></td>
                        <td><? echo $press1  = Ch_Successful("First_year" , "Total" , 326 , 375 ) ;       ?></td>
                        <td><? echo $NOT1    = Ch_Successful("First_year" , "Total" , 300 , 325 ) ;       ?></td>
                    </tr>
                    <tr>
                        <th>Two Year</th>
                        <td><? echo $two     = Ch_Successful("Two_Year" , "Total" , 850 , 999) ;  ?></td>
                        <td><? echo $fallen2 = Ch_Successful("Two_Year" , "Total" , 750 , 849) ;   ?></td>
                        <td><? echo $press2  = Ch_Successful("Two_Year" , "Total" , 651  , 749 ) ;  ?></td>
                        <td><? echo $NOT2    = Ch_Successful("Two_Year" , "Total" , 600 , 650 ) ;  ?></td>
                    <tr>
                         <th>Three Year</th><!--  عايز اعمل داينمك تتحسب مره واحده   -->
                        <td><? echo $three   = Ch_Successful("Three_Year" , "Total" , 850 , 999) ;     ?></td>
                        <td><? echo $fallen3 = Ch_Successful("Three_Year" , "Total" , 750 , 850) ; //  ?></td>
                        <td><? echo $press3  = Ch_Successful("Three_Year" , "Total" , 651 , 749 );     ?></td>
                        <td><? echo $NOT3    = Ch_Successful("Three_Year" , "Total" , 600 , 650 ) ;  ?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <th>
                            <? 
                               echo $Total = $first + $two + $three;  
                            ?>
                        </th>   
                        <th>
                            <? 
                               echo $Total_fallen = $fallen1 + $fallen2 + $fallen3;  
                            ?>
                        </th>
                        <th>
                            <?  
                               echo $Total_Net = $press1 + $press2 + $press3 ;  
                            ?>
                        </th>
                        <th>
                            <? 
                               echo $Total_Not_Net = $NOT1 + $NOT2 + $NOT3 ;  
                            ?>
                        </th>   
                    </tr>
                </tbody>
            </table>
        </div>
<!-- End Table 2 -->
    </div>
</div>
		
<!-- End Content-->
<? include $tpl . "footer.php";?>
