<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\EntrepriseDetails;
use Illuminate\Http\Request;

class EntreprisedetailController extends Controller {
    var $filezise;

    public function __construct() {
        $this->filesize = config('application.image_size');
    }

    //ABOUT
    public function about(Request $request, $id) {
        return EntrepriseDetails::about($request, $id, 'admin.entreprises.about', 'admin/entreprise-detail/about/');
    }

    //SERVICES
    public function services($entreprise = 0) {
        return EntrepriseDetails::services($entreprise, 'admin.entreprises.services');
    }

    public function service($entreprise = 0, $id = 0) {
        return EntrepriseDetails::service($entreprise, $id, 'admin.entreprises.services');
    }

    public function createService(Request $request) {
        return EntrepriseDetails::createService($request, "admin/entreprise-detail/service/", "admin/entreprises-detail/services/");
    }

    public function updateService(Request $request) {
        return EntrepriseDetails::updateService($request, "admin/entreprise-detail/service/", 'admin/entreprises-detail/services/');
    }

    public function deleteService($entreprise, $id) {
        return EntrepriseDetails::deleteService($entreprise, $id, 'admin/entreprises-detail/services/');
    }

    //ADRESSES
    public function adresses($entreprise = 0) {
        return EntrepriseDetails::adresses($entreprise, 'admin.entreprises.adresses');
    }

    public function adresse($entreprise = 0, $id = 0) {
        return EntrepriseDetails::adresse($entreprise, $id, 'admin.entreprises.adresses');
    }

    public function createAdresse(Request $request) {
        return EntrepriseDetails::createAdresse($request, "admin/entreprise-detail/adresse/", 'admin/entreprises-detail/adresses/');
    }

    public function updateAdresse(Request $request) {
        return EntrepriseDetails::updateAdresse($request, "admin/entreprise-detail/adresse/", "admin/entreprises-detail/adresses/");
    }

    public function deleteAdresse($entreprise, $id) {
        return EntrepriseDetails::deleteAdresse($entreprise, $id, 'admin/entreprises-detail/adresses/');
    }

    //PRODUITS
    public function produits($entreprise = 0) {
        return EntrepriseDetails::produits($entreprise, 'admin.entreprises.produits');
    }

    public function produit($entreprise = 0, $id = 0) {
        return EntrepriseDetails::produit($entreprise, $id, 'admin.entreprises.produits');
    }

    public function createProduit(Request $request) {
        return EntrepriseDetails::createProduit($request, "admin/entreprise-detail/produit/", "admin/entreprises-detail/produits/", $this->filesize);
    }

    public function updateProduit(Request $request) {
        return EntrepriseDetails::updateProduit($request, "admin/entreprise-detail/produit/", "admin/entreprises-detail/produits/", $this->filesize);
    }

    public function deleteProduit($entreprise, $id) {
        return EntrepriseDetails::deleteProduit($entreprise, $id, 'admin/entreprises-detail/produits/');
    }

    //PARTENAIRES
    public function partenaires($entreprise = 0) {
        return EntrepriseDetails::partenaires($entreprise, 'admin.entreprises.partenaires');
    }

    public function partenaire($entreprise = 0, $id = 0) {
        return EntrepriseDetails::partenaire($entreprise, $id, 'admin.entreprises.partenaires');
    }

    public function createPartenaire(Request $request) {
        return EntrepriseDetails::createPartenaire($request, "admin/entreprise-detail/partenaire/", "admin/entreprises-detail/partenaires/", $this->filesize);
    }

    public function updatePartenaire(Request $request) {
        return EntrepriseDetails::updatePartenaire($request, "admin/entreprise-detail/partenaire/", "admin/entreprises-detail/partenaires/", $this->filesize);
    }

    public function deletePartenaire($entreprise, $id) {
        return EntrepriseDetails::deletePartenaire($entreprise, $id, 'admin/entreprises-detail/partenaires/');
    }
}
