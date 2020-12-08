<?php 
class c_news extends CI_Controller{

	function index()
	{
		$this->accueil();
	}

	function accueil()
	{	

		$this->load->model('m_news');
		$data=$this->m_news->get_info(); 
		$this->load->view('news/v_news',$data);

	}

	function test_ajout($auteur, $titre, $contenu)
	{
		$this->load->model('m_news');
		$this->m_news->ajouter($auteur, $titre, $contenu); 
	}

	function test_modifier($id, $titre, $contenu)
	{
		$this->load->model('m_news');
		$this->m_news->modifier($id, $titre, $contenu); 
	}

	function test_supprimer($id)
	{
		$this->load->model('m_news');
		$this->m_news->supprimer($id); 
	}

	function test_count($where)
	{
		$array=array('auteur'=>$where);
		$this->load->model('m_news');
		$data['id']=$this->m_news->count($array); 
		$this->load->view('news/v_compte',$data);
	}

	function lister_news()
	{
		$this->load->model('m_news');
		$data=$this->m_news->lister();
		$data['liste']=$this->m_news->lister(); 
		$this->load->view('news/v_lister',$data);
	}
}	