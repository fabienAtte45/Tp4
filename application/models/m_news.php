<?php  
class M_news extends CI_Model
{
	public function get_info()
	{
		//	On simule l'envoi du résultat d'une requête
		return array('auteur' => 'Gaston Lagaff',
		'titre' => 'Un premier modèle',
		'contenu' => ' Mon premier modèle simule une requête' ,
		'dateaj' => '24/07/20',
		 'datemo' => '28/07/20');
	}

	 private $table='news';
 
/**
	 *	Ajoute une news
	 *	@param string $auteur:	L'auteur de la news
	 *	@param string $titre:	 	Le titre de la news
	 *	@param string $contenu: 	Le contenu de la news
	 *	@return bool:			Le résultat de la requête
	 */
	public function ajouter($auteur, $titre, $contenu)
	{
	//Données automatiquement échappées (= pas interprétées)
		$this->db->set('auteur',  $auteur);
		$this->db->set('titre',   $titre);
		$this->db->set('contenu', $contenu);
		
	//Données interprétées grâce au booléen false : NOW() donnera la date du jour
		$this->db->set('date_ajout', 'NOW()', false);
		$this->db->set('date_modif', 'NOW()', false);
		
		//	Les champs sont définis, on "insère" le tout
		return $this->db->insert($this->table);
	} 

public function modifier($idP, $titre = null, $contenu = null)
// =null: valeur par défaut si aucune nouvelle valeur fournie

{
	// Aucune nouvelle valeur fournie
		if($titre == null AND $contenu == null)
		{
			return false;
		}
		if($titre != null)
		{
			$this->db->set('titre', $titre);
		}
		if($contenu != null)
		{
			$this->db->set('contenu', $contenu);
		}
		$this->db->set('date_modif', 'NOW()', false);
	
		// La condition pour modifier la news ayant pour id $id
		$this->db->where('id', (int) $idP);
	
		return $this->db->update($this->table);

}
public function supprimer ($idP)
{
	
	$this->db->where('id', (int) $idP);
	return $this->db->delete($this->table);

}

/**
 *	Retourne le nombre de news.
 *	
 *	@param array $where	Tableau associatif permettant de définir des conditions
 *	@return integer		Le nombre de news satisfaisant la condition
 */
public function count($where = array())
{
	return (int) $this->db->where($where)
			      ->count_all_results($this->table);
}

/**
 *	Retourne une liste de $nb dernières news.
 *
 *	@param integer 	$nb	Le nombre de news souhaité
 *	@param integer 	$debut	L'indice de la première news
 *	@return collection d'objets contenant la liste de news
 */
public function lister ($nb = 10, $debut = 0)
{
	return $this->db->select('*')
	->from($this->table)
	->limit($nb, $debut)
	->order_by('id', 'desc')
	->get()
	->result();
}

}

?>
