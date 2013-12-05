<?php
/***********************************************************/
// Auteur : Kevin FRAPIN
// Web: www.recia.fr
// Date: 11/01/12
// Contenu: 
//  Gestion de la connexion a la base de donnees en 
//  en utilisant le driver PDO
/***********************************************************/

//------------------------------------------------- INCLUDE

if 		(file_exists("../../config/config.inc.php"))  require_once("../../config/config.inc.php");
elseif	(file_exists("../config/config.inc.php")) 	  require_once("../config/config.inc.php");
elseif	(file_exists("./config/config.inc.php"))      require_once("./config/config.inc.php");

require_once($LEA_REP."lib/stdlib.php");
require_once($LEA_REP."modele/bdd/classe_apprenti.php");
require_once($LEA_REP."modele/bdd/classe_enseignant.php");
require_once($LEA_REP."modele/bdd/classe_entreprise.php");
require_once($LEA_REP."modele/bdd/classe_maitre_apprentissage.php");
require_once($LEA_REP."modele/bdd/classe_representant_legal.php");

//-------------------------------------------------- CLASSE
class Connexion_BDD_LEA_PDO
{

	//------------------------------------------- ATTRIBUTS
	var $hostname;  		// Nom de l'hote hebergeant la base
	var $database;			// Le nom de la bases de données LEA
	var $username;     		// Utilisateur de la BD
	var $password;          // Mot de passe pour acceder a la BD
	var $erreurs;			// Liste d'erreurs
	var $requete;           // Derniere requete executee

	var $pdo;				// Objet PDO gerant la connexion
	
	//---------------------------------------- CONSTRUCTEUR
	function Connexion_BDD_LEA_PDO( )
	{
		global $BDD;
		
		$this->erreurs = array();
		$this->hostname = $BDD[ 'hostname' ];
		$this->database = $BDD[ 'database' ];
		$this->username = $BDD[ 'username' ];
		$this->password = $BDD[ 'password' ];
		
	}

	
	//------------------------------------- METHODES PUBLIC
	/*
	 * Fonction etablissant la connexion a la base de donnees
	 */
	function connexion( )
	{
		try 
		{
			// Connexion a la base
			$this->establishUniqueConnection( );
		}
		catch ( PDOException $e )
		{
			// Erreur lors de la connexion
			afficher_msg_erreur( "Impossible de se connecter a la base de donnees LEA : " . $e->getMessage( ) );
			exit( );
		}
	}

	/*
	 * Fonction instanciant une seule connexion en meme temps
	 */
	function establishUniqueConnection( )
	{
		if( ! $this->isConnected( ) )
		{
			$this->pdo = new PDO( "mysql:host=$this->hostname;dbname=$this->database",
			$this->username,
			$this->password,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
			
			// Activation de l'autocommit
			$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
		}
	}
	

	/*
	* Fonction permettant de lier des valeurs a une requete
	*
	* Parametres :
	*   - $sth : La requete preparee
	*   - $values : Tableau associatif des parametres a lier dans la requete
	*   - $type : Le type des parametres
	*
	* Exemple de $values : array( ':couleur' => 'rouge', ':id' => '5' )
	*/
	function bindValues( $sth, $values, $type = PDO::PARAM_STR )
	{
		if( $sth != null )
		{
			foreach( $values as $param => $value )
			{
				$cleanValue = $this->cleanString( $value );
				$sth->bindValue( $param, $cleanValue, $type );
			}
		}
	}
	
	/*
	 * Fonction executant une requete preparee
	 */
	function execute( $sth, $display_error=1 )
	{
		// Sauvegarde de la requete et connexion a la BD
		$this->requete = $sth;
		$this->connexion( );
		
		if( $this->isConnected( ) ) 
		{
			// Execution de la requete
			$success = $sth->execute( );
			if ( !$success && $display_error )
			// Si la requete a echoue
			{
				afficher_msg_erreur( "Impossible d'executer la requête  : " . " <br>".$sth->queryString );
			}
		}
	}
	
	/*
	* Fonction permettant de parcourir le resutat d'une requete
	* executee
	*/
	function fetch( $sth, $mode )
	{
		if( $sth != null )
		{
			return $sth->fetch( $mode );
		}
	}
	
	/*
	* Fonction retournant l'identifiant de la derniere ligne inseree
	* 
	* Parametres:
	*   - $table_name : Le nom de la table ou recuperer l'id
	*   - $column_id : La colonne representant l'id
	* 
	* NOTE:
	*   Cette methode n'est pas tres portable et devrait etre
	*   implementee via PDO::lastInsertId(), mais celle-ci
	*   pose quelque probleme sur certaines configuration 
	*   de bases MySQL
	* 
	*/
	function lastInsertId( $table_name, $column_id )
	{
		if( $this->isConnected( ) )
		{
			// Preparation de la requete pour recuperer l'id en base de donnees
			$statement = 'SELECT '.$column_id
							.' FROM '.$table_name
							.' ORDER BY '.$column_id
							.' DESC LIMIT 1';
			$sth = $this->prepare( $statement );
			$this->execute( $sth );
			
			// Extraction de l'id
			$ligne  = $this->fetch( $sth, PDO::FETCH_ASSOC );
			if( $ligne )
			{
				return $ligne[ $column_id ];
			}
		}
	}
	
	/*
	* Fonction permettant de preparer une requete
	*/
	function prepare( $statement )
	{
		if( ! $this->isConnected( ) )
		{
			$this->connexion( );
		}
		return $this->pdo->prepare( $statement );
	}

	/*
	 * Fonction permettant de fermer la connexion a la BD
	 */
	function deconnexion( ) 
	{
		$this->pdo = null;
	}


	/* 
	 * Fonction renvoyant le profil d'un utilisateur par
	 * son identifiant
	 */
	function getprofil( $id_usager )
	{
		// Preparation de la requete et liage des parametres
		$statement = 'SELECT profil FROM les_usagers WHERE id_usager=:id';
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth, array( ':id' => $id_usager ), PDO::PARAM_INT );
				
		// Execution de la requete
		$result = $this->execute( $sth );
		$ligne = $this->fetch( $sth, PDO::FETCH_ASSOC );
		return $ligne[ 'profil' ];


	}
	
	/*
	 * Fonction recuperant tous les usagers d'une formation
	 */
	function get_all_usagers_for( $for )
	{
		// Preparation de la requete
		$statement = 'SELECT id_usager FROM les_usagers 
						WHERE profil LIKE \'rvs%\' or profil LIKE \'admin%\' 
						OR profil LIKE \'ma%\' 
						ORDER BY profil';
		$sth = $this->prepare( $statement );
		$result = $this->execute( $sth );
		
		// Recuperation des identifiants des usagers
		$les_id = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$les_id[] = $ligne[ 'id_usager' ];
		}
		
		// Preparation de la requete et liage de parametres
		$statement = 'SELECT id_app,id_rl 
						FROM les_apprentis A, les_classes B 
						WHERE A.id_cla = B.id_cla AND B.id_for=:for';
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth, array( ':for' => $for ) );
		$this->execute( $sth ); 
		
		// Recuperation des identifiants des apprentis
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$les_id[ ] = $ligne[ 'id_app' ];
			$les_id[ ] = $ligne[ 'id_rl' ];
		}
		
		// Preparation de la requete et liage de parametres
		$statement = 'SELECT id_ens 
						FROM les_enseignants_formations 
						WHERE id_for=:for';
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth, array( ':for' => $for ) );
		$this->execute( $sth );
		
		// Recuperation des identifiants des enseignants
		while ($ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) ) 
		{
			$idens = $ligne[ 'id_ens' ];
			$les_id[ ] = $idens;
		}

		// Recuperation finale des usagers
		$les_usagers = array( );
		for( $i=0; $i < sizeof( $les_id ); $i++ )
		{
			// Preparation et liage de parametres pour recuperer un usager
			$id = $les_id[ $i ];
			$statement='SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
						FROM les_usagers
			     		WHERE id_usager=:id' ;
			$sth = $this->prepare( $statement );
			$this->bindValues( $sth, array( ':id' => $id ), PDO::PARAM_INT );
			$this->execute( $sth );

			// Recuperation de l'usager
			while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
			{
				$usager = new Usager( $ligne[ 'id_usager' ] );
				$usager->civilite = $ligne[ 'civilite' ];
				$usager->nom = $ligne[ 'nom' ];
				$usager->prenom = $ligne[ 'prenom' ];
				$usager->adresse = $ligne[ 'adresse' ];
				$usager->tel_fixe = $ligne[ 'tel_fixe' ];
				$usager->tel_mobile = $ligne[ 'tel_mobile' ];
				$usager->email=$ligne[ 'email' ];
				$usager->url_site = $ligne[ 'url_site' ];
				$usager->date_creation = trans_date( $ligne[ 'date_creation' ] );
				$usager->date_derniere_connexion = trans_date_time( $ligne[ 'date_derniere_connexion' ] );
				$usager->nombre_connexions = $ligne[ 'nombre_connexions' ];
				$usager->mode_acces = $ligne[ 'mode_acces' ];
				$usager->date_debut_acces = $ligne[ 'date_debut_acces' ];
				$usager->date_fin_acces = $ligne[ 'date_fin_acces' ];
				$usager->login = $ligne[ 'login' ];
				$usager->mdp = $ligne[ 'mdp' ];

				$les_usagers[ ] = $usager;
			}
		}
		return $les_usagers;
	}

	/*
	 * Fonction recuperant les usagers (non apprentis et non parents) ayant
	 * un nom commencant par mot_cle 
	 */
	function get_all_usagers( $pos, $nb, $mot_cle="" ) 
	{
		// Preparation de la requete et liage de parametres			
		$statement = 'SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
				 		FROM les_usagers
				 		WHERE nom LIKE :motcle AND profil!=\'app\' AND profil!=\'rl\'		
			     		ORDER BY nom 
		   	     		LIMIT :pos, :nb' ; 		   
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth,  array( ':motcle' => $mot_cle.'%' ) );
		$this->bindValues( $sth, array( ':pos' => $pos, ':nb' => $nb ), PDO::PARAM_INT );
		$this->execute( $sth );
		
		// Recuperation des usagers
		$les_usagers = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$usager = new Usager($ligne[ 'id_usager' ]);
			
			$usager->civilite = $ligne[ 'civilite' ];
			$usager->nom = $ligne[ 'nom' ];
			$usager->prenom = $ligne[ 'prenom' ];
			$usager->adresse = $ligne[ 'adresse' ];
			$usager->tel_fixe = $ligne[ 'tel_fixe' ];
			$usager->tel_mobile = $ligne[ 'tel_mobile' ];
			$usager->email=$ligne[ 'email' ];
			$usager->url_site = $ligne[ 'url_site' ];
			$usager->date_creation = trans_date( $ligne[ 'date_creation' ] );
			$usager->date_derniere_connexion = trans_date_time( $ligne[ 'date_derniere_connexion' ] );
			$usager->nombre_connexions = $ligne[ 'nombre_connexions' ];
			$usager->mode_acces = $ligne[ 'mode_acces' ];
			$usager->date_debut_acces = $ligne[ 'date_debut_acces' ];
			$usager->date_fin_acces = $ligne[ 'date_fin_acces' ];
			$usager->login = $ligne[ 'login' ];
			$usager->mdp = $ligne[ 'mdp' ];

			$les_usagers[ ] = $usager;
		}
		return $les_usagers;
	}

	/*
	* Fonction recuperant les usagers ayant un nom commencant par mot_cle
	* et ayant le profil semblable a celui passe en parametre
	*/
	function get_usagers( $pos, $nb, $profil, $mot_cle="" )
	{
		// Preparation de la requete et liage de parametres pour recuperer
		// les usagers	
		$statement = 'SELECT id_usager, civilite, nom, prenom, adresse, tel_fixe, tel_mobile,
		   				email, url_site, date_creation, date_derniere_connexion, 
						nombre_connexions, mode_acces, date_debut_acces, date_fin_acces,
						login, mdp
				 		FROM les_usagers
						WHERE profil LIKE :profil AND nom LIKE :motcle		
			     		ORDER BY nom 
		   	     		LIMIT :pos, :nb'; 		   
		$sth = $this->prepare( $statement );
		// Parametres a lier
		$intValues = array( ':pos' => $pos, ':nb' => $nb );
		$stringValues = array( ':profil' => '%'.$profil.'%', ':motcle' => $mot_cle.'%' );
		// Liage des parametres
		$this->bindValues( $sth, $stringValues );
		$this->bindValues( $sth, $intValues, PDO::PARAM_INT );
		$this->execute( $sth );
		
		// Recuperation des usagers
		$les_usagers = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$id_usager = $ligne[ 'id_usager' ];
			switch( $profil ) 
			{
				case "app":
					$usager = new Apprenti( $id_usager );
					break;
				case "ens":
					$usager = new Enseignant( $id_usager );
					break;
				case "ma":
					$usager= new Maitre_apprentissage( $id_usager );
					break;
				case "rl":
					$usager = new Representant_legal( $id_usager );
					break;
				default  :
					$usager = new Usager( $id_usager );
					break;
			}

			$usager->civilite = $ligne[ 'civilite' ];
			$usager->nom = $ligne[ 'nom' ];
			$usager->prenom = $ligne[ 'prenom' ];
			$usager->adresse = $ligne[ 'adresse' ];
			$usager->tel_fixe = $ligne[ 'tel_fixe' ];
			$usager->tel_mobile = $ligne[ 'tel_mobile' ];
			$usager->email=$ligne[ 'email' ];
			$usager->url_site = $ligne[ 'url_site' ];
			$usager->date_creation = trans_date( $ligne[ 'date_creation' ] );
			$usager->date_derniere_connexion = trans_date_time( $ligne[ 'date_derniere_connexion' ] );
			$usager->nombre_connexions = $ligne[ 'nombre_connexions' ];
			$usager->mode_acces = $ligne[ 'mode_acces' ];
			$usager->date_debut_acces = $ligne[ 'date_debut_acces' ];
			$usager->date_fin_acces = $ligne[ 'date_fin_acces' ];
			$usager->login = $ligne[ 'login' ];
			$usager->mdp = $ligne[ 'mdp' ];

			$les_usagers[ ] = $usager;
		}
		return $les_usagers;
	}

	/*
	 * Cette fonction supprime tous les usagers de profil $profil et ayant un nom commence par $mot_cle
	 *   app : les apprentis.
	 *   ens : les enseignants.
	 *   ma  : les maitres d'apprentissages.
	 *   rl  : les représentant légaux (parents).
	 *   rvs : les responsable vies scoalire.
	 */
	function delete_all_usagers( $profil, $mot_cle="" )
	{
		// Preparation de la requete et liage de parametres pour recuperer
		// les usagers
		$statement = 'SELECT id_usager
						FROM les_usagers			   
			    		WHERE profil LIKE :profil AND nom LIKE :motcle';
		$sth = $this->prepare( $statement );
		$values = array( ':profil' => '%'.$profil.'%', ':motcle' => '%'.$mot_cle.'%' );
		$this->bindValues( $sth, $values );
		$this->execute( $sth );
		
		// Supression des usagers
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$usager = new Usager( $ligne[ 'id_usager' ] );
			// TODO : Corriger les fonctions de suppressions,...
			$usager->delete_usager( );
		}
	}


	/*
	 * Fonction renvoyant un tableau contenant la liste de tous les apprentis non affectés 
	 */
	function get_apprentis_non_affectes( $pos=0, $nb=100000, $mot_cle="" ) 
	{
		// Preparation de la requete et liage de parametres
		$statement = 'SELECT id_usager, civilite, nom, prenom, adresse, 
						tel_fixe, tel_mobile, email, url_site, date_creation,
						date_derniere_connexion, nombre_connexions, mode_acces,
						date_debut_acces, date_fin_acces, login, mdp 
					FROM les_usagers U , les_apprentis A
					WHERE U.id_usager= A.id_app AND profil 
						LIKE \'%app%\' AND  id_cla=0 AND  nom LIKE :motcle	
					ORDER BY U.nom 
					LIMIT :pos, :nb';
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth, array( ':motcle' => '%'.$mot_cle.'%' ) );
		$this->bindValues( $sth, array( ':pos' => $pos, ':nb' => $nb ), PDO::PARAM_INT );
		$this->execute( $sth );
		
		
		// Recuperation des apprentis
		$les_usagers = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$usager = new Apprenti($ligne[ 'id_usager' ]);
			$usager->civilite = $ligne[ 'civilite' ];
			$usager->nom = $ligne[ 'nom' ];
			$usager->prenom = $ligne[ 'prenom' ];
			$usager->adresse = $ligne[ 'adresse' ];
			$usager->tel_fixe = $ligne[ 'tel_fixe' ];
			$usager->tel_mobile = $ligne[ 'tel_mobile' ];
			$usager->email=$ligne[ 'email' ];
			$usager->url_site = $ligne[ 'url_site' ];
			$usager->date_creation = trans_date($ligne[ 'date_creation' ]);
			$usager->date_derniere_connexion = trans_date_time($ligne[ 'date_derniere_connexion' ]);
			$usager->nombre_connexions = $ligne[ 'nombre_connexions' ];
			$usager->mode_acces = $ligne[ 'mode_acces' ];
			$usager->date_debut_acces = $ligne[ 'date_debut_acces' ];
			$usager->date_fin_acces = $ligne[ 'date_fin_acces' ];

			$les_usagers[] = $usager;
		}
		return $les_usagers;
	}

	/* 
	 * Fonction renvoyant le nombre d'usagers de profils $profil et ayant un nom commence 
	 * par le mot cle $mot_cle
	*/ 
	function get_nb_usagers( $profil, $mot_cle="" )
	{
		// Preparation de la requete et liage de parametre
		$statement='SELECT COUNT(id_usager) nb
			   		FROM les_usagers 
			   		WHERE profil LIKE :profil AND nom LIKE :motcle';
		$sth = $this->prepare( $statement );
		$values = array( ':profil' => '%'.$profil.'%', ':motcle' => '%'.$mot_cle.'%' );
		$this->bindValues( $sth, $values );
		$this->execute( $sth );
		
		// Recuperation du nombre d'usagers
		if ($ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			return $ligne[ "nb" ];
		}
		else 
		{
			return 0;
		}
	}

	/* Fonction renvoyant un tableau contenant toutes les entreprises ayant un 
	 * nom qui comence par $mot_cle.
	 * 
	 * On récupère un nombre $nb d'entreprise à partir de la position de debut $pos 
	 */
	function get_entreprises( $pos=0, $nb=10000, $mot_cle="" ) 
	{
		// Preparation de la requete et liage de parametres
		$statement = 'SELECT id_entr, nom, adresse, code_postal, ville, tel_fixe1, tel_fixe2, fax, email, url_site, secteur_activite,
		 			  nom_contact, prenom_contact, nb_salaries, nb_apprentis		 
			   			FROM les_entreprises
			   			WHERE nom LIKE :motcle
			   			ORDER BY nom
			   			LIMIT :pos, :nb';
		$sth = $this->prepare( $statement );
		// Parametres a lier
		$stringValues = array( ':motcle' => $mot_cle.'%' );
		$intValues = array( ':pos' => $pos, ':nb' => $nb );
		// Liage des parametres
		$this->bindValues( $sth, $stringValues );
		$this->bindValues( $sth, $intValues, PDO::PARAM_INT);
		
		$this->execute( $sth );
		
		// Recuperation des entreprises
		$les_entreprises = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$entreprise = new Entreprise($ligne[ 'id_entr' ]);
			$entreprise->nom = $ligne[ 'nom' ];
			$entreprise->adresse = $ligne[ 'adresse' ];
			$entreprise->code_postal = $ligne[ 'code_postal' ];
			$entreprise->ville = $ligne[ 'ville' ];
			$entreprise->tel_fixe1 = $ligne[ 'tel_fixe1' ];
			$entreprise->tel_fixe2 = $ligne[ 'tel_fixe2' ];
			$entreprise->fax = $ligne[ 'fax' ];
			$entreprise->email= $ligne[ 'email' ];
			$entreprise->url_site = $ligne[ 'url_site' ];
			$entreprise->secteur_activite = $ligne[ 'secteur_activite' ];
			$entreprise->nom_contact = $ligne[ 'nom_contact' ];
			$entreprise->prenom_contact = $ligne[ 'prenom_contact' ];
			$entreprise->nb_salaries = $ligne[ 'nb_salaries' ];
			$entreprise->nb_apprentis = $ligne[ 'nb_apprentis' ];

			$les_entreprises[ ] = $entreprise;
		}
		return $les_entreprises;
	}

	/* 
	 * Fonction renvoyant le nombre d'entreprises ayant un nom similaire a mot_cle
	 * $mot_cle
	*/
	function get_nb_entreprises( $mot_cle="" )
	{
		// Preparation de la requete et liage de parametres
		$statement ='SELECT COUNT(id_entr) nb
			  			FROM les_entreprises 
   		      			WHERE nom LIKE :motcle';
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth, array( ':motcle' => '%'.$mot_cle.'%' ) );
		$this->execute( $sth );
		
		// Recuperation du nombre d'entreprises
		if ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			return $ligne[ "nb" ];
		}
		else 
		{
			return 0;
		}
	}

	/*
	 * Fonction supprimant toutes les entreprises ayant un nom commencant
	 * par le mot cle $mot_cle
	 */

	function delete_all_entreprises( $mot_cle="" )
	{
		// Preparation de la requete et liage de parametres
		$statement = 'DELETE FROM les_entreprises
					  WHERE  nom LIKE :mot_cle';
		$sth = $this->prepare( $statement );
		$this->bindValues( $sth, array( ':motcle' => $mot_cle.'%' ) );

		// Suppression de l'entreprise
		$this->execute( $sth );
	}


	/* 
	 * Cette fonction renvoit un tableau contenant tous les identifiants des formations 
	 * existantes
	 */
	function get_id_formations( )
	{
		// Preparation de la requete
		$statement = 'SELECT  id_for
			   			FROM les_formations
			   			WHERE id_for > 0
			   			ORDER BY nom';
		$sth = $this->prepare( $statement );
		$this->execute( $sth );
		
		// Recuperation des identifiants des formations
		$les_id_formations = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$les_id_formations[] = $ligne[ 'id_for' ];
		}
		return $les_id_formations;
	}


	/* 
	 * Fonction renvoyant un tableau contenant toutes les classes enregistrées
	 */

	function get_classes( ) 
	{
		// Preparation de la requete
		$statement = 'SELECT  id_cla, libelle
			   			FROM les_classes
			   			ORDER BY libelle';
		$sth = $this->prepare( $statement );
		$this->execute( $sth );
		
		// Recuperation des classes
		$les_classes = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$classe = new Classe( $ligne[ 'id_cla' ] );
			$classe->libelle = $ligne[ 'libelle' ];
			$les_classes[ ] = $classe;
		}
		return $les_classes;
	}

	/* 
	 * Fonction renvoyant un tableau contenant toutes les formations enregistrées
	 */
	function get_formations( )
	{
		// Preparation de la requete
		$statement='SELECT  id_for, nom
			   			FROM les_formations
			  			ORDER BY nom';
		$sth = $this->prepare( $statement );
		$this->execute( $sth );
		
		// Recuperation des formations
		$les_formations = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$formation = new Formation($ligne[ 'id_for' ]);
			$formation->nom = $ligne[ 'nom' ];
			$les_formations[] = $formation;
		}
		return $les_formations;
	}



	/*
	 * Fonction renvoyant un tableau contenant toutes les unités pédagogiques du CFA	
	 */
	function get_all_unites_pedagogiques( )
	{
		// Preparation de la requete
		$statement = "SELECT id_unite, nom, adresse, tel_fixe1, tel_fixe2, fax, email, url_site,
		 			  nom_contact, prenom_contact
			   		FROM les_unites_pedagogiques
			   		ORDER BY nom";
		$sth = $this->prepare( $statement );
		$this->execute( $sth );
		
		// Recuperation des unites pedagogiques
		$les_unites = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$unite = new Unite_pedagogique($ligne[ 'id_unite' ]);
			$unite->nom = $ligne[ 'nom' ];
			$unite->adresse = $ligne[ 'adresse' ];
			$unite->tel_fixe1 = $ligne[ 'tel_fixe1' ];
			$unite->tel_fixe2 = $ligne[ 'tel_fixe2' ];
			$unite->fax = $ligne[ 'fax' ];
			$unite->email = $ligne[ 'email' ];
			$unite->url_site = $ligne[ 'url_site' ];
			$unite->nom_contact = $ligne[ 'nom_contact' ];
			$unite->prenom_contact = $ligne[ 'prenom_contact' ];

			$les_unites[ ] = $unite;
		}
		return $les_unites;
	}

	/*
	 * Cette fonction renvoit un tableau contenant la liste des options des options lea
	 * les  options sont:
	 * - SRC_BACHGOUND_HEAD : nom de l'image de fond de l'entéte LEA
	 * - SRC_LOGO_CFA       : nom du de l'image représentant le logo cfa
	 * 
	 */

	function get_options( ) 
	{
		// Preparation de la requete
		$statement = "SELECT nom, valeur
			   			FROM les_options";
		$sth = $this->prepare( $statement );
		$this->execute( $sth );
		
		// Recuperation des options
		$les_options = array( );
		while ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) )
		{
			$nom = $ligne[ 'nom' ];
			$valeur = $ligne[ 'valeur' ];
			$les_options[ $nom ] = $valeur;
		}
		return $les_options;
	}
	
	/*
	 * Fonction indiquant si la connexion est etablie
	 */
	function isConnected( )
	{
		return ( $this->pdo != null );
	}

	/*
	 * Fonction mettant à jour l'option du nom $nom et de valeur $valeur	
	 */

	function update_option( $nom, $valeur )
	{
		// Preparation de la requete
		$statement = 'UPDATE les_options
			   			SET valeur = :valeur
			   			WHERE nom = :nom';  
		$sth = $this->prepare( $statement );
		$values = array( ':valeur' => $valeur, ':nom' => $nom );
		$this->bindValues( $sth, $values );
		
		// Mise a jour de l'option
		$this->execute( $sth );
	}

	/*
	 * Fonction renvoyant 1 si l'usager d'identifiant $id_usager est concerne par 
	 * l'espace d'identifiant $id_espace
	 */

	function consulte_espace( $id_acteur, $id_espace )
	{
		// Preparation de la requete
		$statement = 'SELECT id_acteur
			   			FROM acteurs_espace
			   			WHERE id_espace=:idespace
						AND id_acteur=:idacteur';
		$sth = $this->prepare( $statement );
		$values = array( ':idespace' => $id_espace, ':idacteur' => $id_acteur );
		$this->bindValues( $sth, $values, PDO::PARAM_INT );
		$this->execute( $sth );

		if ( $ligne = $this->fetch( $sth, PDO::FETCH_ASSOC ) ) 
		// Si l'usager est concerne par l'espace
		{
			return 1;
		}
		else 
		{
			return 0;
		}
			
	}
	
	//------------------------------------- METHODES PROTECTED
	/*
	 * Fonction permettant de nettoyer une chaine de caractere
	 * avant son insertion eventuelle en base de donnees
	 */
	protected function cleanString( $string )
	{
		return stripslashes( $string );
	}
	
}
?>
