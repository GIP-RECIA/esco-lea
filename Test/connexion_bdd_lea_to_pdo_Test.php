<?php
/***********************************************************/
// Auteur : Kevin FRAPIN
// Web: www.recia.fr
// Date: 11/01/12
// Contenu:
//
//  Classe permettant de tester de maniere unitaire
//  le passage du LEA a une version utlisant le driver PDO.
//
//  Les tests comparent les resultats obtenus par l'ancienne
//  methode et ceux obtenus avec le driver PDO. 
//  Ces resultats doivent etre identiques pour considere la
//  migration comme fonctionnelle.
/***********************************************************/

//------------------------------------------------- INCLUDE

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."modele/bdd/connexion_bdd_lea.php");
require_once($LEA_REP."modele/bdd/connexion_bdd_lea_pdo.php");


//-------------------------------------------------- CLASSE
class Connexion_BDD_LEA_TO_PDO_TEST extends PHPUnit_Framework_TestCase
{
	//---------------------------------- TESTS CONSTRUCTEUR
    public function test_connexion_BDD_LEA_PDO( )
    {
        $connexionBdPdo = new Connexion_BDD_LEA_PDO( );
        $this->assertNotNull( $connexionBdPdo );
    }
    
    //-------------------------------------- TESTS METHODES
    public function test_connexion( )
    {
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	$connexionBdPdo->connexion( );
    	$this->assertTrue( $connexionBdPdo->isConnected( ) );
    }
    
    public function test_get_all_unites_pedagogiques( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_all_unites_pedagogiques( );
    	$result = $connexionBdPdo->get_all_unites_pedagogiques( );
    	 
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_all_usagers( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_all_usagers( 1, 10 );
    	$result = $connexionBdPdo->get_all_usagers( 1, 10 );

    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_all_usagers_for( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_all_usagers_for( 1 );
    	$result = $connexionBdPdo->get_all_usagers_for(1 );

    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_apprentis_non_affectes( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_apprentis_non_affectes( );
    	$result = $connexionBdPdo->get_apprentis_non_affectes( );
    	 
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_consulte_espace( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->consulte_espace( 1, 1 );
    	$result = $connexionBdPdo->consulte_espace( 1, 1 );

    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_entreprises( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_entreprises( );
    	$result = $connexionBdPdo->get_entreprises( );
    	 
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_formations( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_formations( );
    	$result = $connexionBdPdo->get_formations( );
    	 
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    public function test_get_id_formations( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	
    	// Execution de la meme requete
    	$expected = $connexionBd->get_id_formations( );
    	$result = $connexionBdPdo->get_id_formations( );
    	
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_nb_entreprises( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->get_nb_entreprises( );
    	$result = $connexionBdPdo->get_nb_entreprises( );
    	 
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_nb_usagers( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	
    	// Execution de la meme requete
    	$expected = $connexionBd->get_nb_usagers( "" );
    	$result = $connexionBdPdo->get_nb_usagers( "" );
    	
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_options( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	
    	// Execution de la meme requete
    	$expected = $connexionBd->get_options( );
    	$result = $connexionBdPdo->get_options( );
    	
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_get_usagers( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    
    	// Execution de la meme requete
    	$expected = $connexionBd->get_usagers( 1, 10, "");
    	$result = $connexionBdPdo->get_usagers( 1, 10, "" );
    
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
    public function test_getprofil( )
    {
    	// Avec et sans utilisation du driver PDO
    	$connexionBd = new Connexion_BDD_LEA( );
    	$connexionBdPdo = new Connexion_BDD_LEA_PDO( );
    	 
    	// Execution de la meme requete
    	$expected = $connexionBd->getprofil( 1 );
    	$result = $connexionBdPdo->getprofil( 1 );
    	 
    	// Identiques ?
    	$this->assertEquals( $expected, $result );
    }
    
}
?>