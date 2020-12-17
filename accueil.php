<!DOCTYPE html>
<?php
	include("connect.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<style>
	img{
		width: 70px;
		height: 70px;
	}
	#nav{
		background-color: #00008B;
		height: 50px;
	}
 .pied{
 	height: 700px;
    background-color: #F0FBFF;}

    .footer{
    height: 50px;

    background-color: #00008B;	
    }
</style>
	
</head>
<body>
<div class="contrain-fluid">
	<div class="row a">
		<div class="am"><img src="img/logo.jpg">

		</div>
		<div class="ttr">
			<h1 style="color: #00008B">EUROBuvette</h1>
			<h6 style="color: #00FFFF">le site de gestion du buvette de l'EURO 2016 !!</h6>
		</div>

    </div></div>
    
    <div class="row" id="nav">
    	  <div class="col-md-2"></div>
          <div class="col-md-2"><a class="active" href="accueil.php" style="color: white">Nouveautés</a></div>

          <div class="col-md-2">  <a href="Statistiques.php" style="color: white">Statistiques</a></div>
          <div class="col-md-2"> <a href="recherchemembres.php" style="color: white">Recherche membres </a></div>
          <div class="col-md-2"> <a href="affectations.php" style="color: white">Affectation </a></div>
          <div class="col-md-2"> <a href="prive.php" style="color: white">Administrateurs </a></div>
      </div>
 	
  	
                  
            <?php
            $requete="SELECT m.date,a.pays as paysA, b.pays as paysB, a.drapeau as drapeauA, b.drapeau as drapeauB, scoreA, scoreB, COUNT(*) as nb_bo ,m.idM
            from `match` m, `equipe` a, `equipe` b ,`est_ouverte` eo
           WHERE a.idE=m.eqA
		   AND b.idE=m.eqB
			AND m.idM=eo.idM
			GROUP BY m.idM
            ";
            $result=mysqli_query($db,$requete) ; 

           // var_dump($result);
            if(mysqli_num_rows($result)==0){
                echo "Aucun enregistrement trouvé";
            }
            else{
            ?>
        
        <table border="1" width="80%" align="center">
            <tbody>
                <th>date du match </th>
                <th>equipe A </th>
                <th>equipe B </th>
               <th>score  </th>
               <th>buvette ouverte</th>
               <th>volontaires</th>
            </tbody>   
   
       <?php 
	
	   
      
	   
	   
	   
	    while($row=mysqli_fetch_array($result)){
			$r1="SELECT COUNT(*)  As nb
			FROM `match` m,`est_present` ep 
			WHERE m.idM=ep.idM
			AND m.idM=".$row['idM'];
			$Execution=mysqli_query($db,$r1);
			$nbvolo=mysqli_fetch_array($Execution);
		   
	
          
           echo"
           <tr>
            <td>".
            $row['date'].
            "</td>

            <td><img src=\"".$row['drapeauA']."\" alt=\"".$row['paysA']."\" height=\"50px\"/></td>
            <td><img src=\"".$row['drapeauB']."\" alt=\"".$row['paysB']."\" height=\"50px\"/></td>
            <td>".$row['scoreA']." - " .$row['scoreB']."</td>
			<td>".$row['nb_bo']."</td>
			<td>".$nbvolo['nb']."</td>
			
            </tr>
            ";
			
       }
	   ?>
	  
	   
          
         
			
			
			
 
	
    <?php } ?>


 
  </table>


 </div>
 


 <div class="footer"> pied de la page</div>
   


	
</body> <div  class="pied">
</html>