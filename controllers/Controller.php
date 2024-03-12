<?php

class Controller
{

	public function __construct()
	{
	}

	/**
	 * Charger un modèle
	 *
	 * @param string $model
	 */

	public function loadModel(string $model)
	{
		// On crée une instance de ce modèle.
		return new $model();
	}

	/**
	 * Afficher une vue
	 *
	 * @param string $fichier
	 * @param array $data
	 */
	public function render(string $fichier): void
	{
		$class = strtolower(get_class($this)); // Par exemple : chatController
		$dir = preg_replace("#controller#", "", $class);

		// Crée le chemin et inclut le fichier de vue
		require_once(ROOT . 'views/' . $dir . '/' . $fichier . '.php');
	}
}
