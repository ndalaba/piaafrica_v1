<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 09/05/16
 * Time: 09:51
 */

namespace App\Http\Models;

use Illuminate\Http\Request;


class EntrepriseDetails {

    //ABOUT
    public static function about(Request $request, $id, $view, $redirect) {
        $about = About::where('entreprise_id', $id)->first();
        if ($about == null)
            $about = new About();
        $entreprise = Entreprise::find($id);
        if ($request->isMethod('post')) {
            if ($about != null)
                $about->delete();
            About::create($request->all());
            return redirect($redirect . $id);
        }
        else {
            return view($view)->with('about', $about)->with('entreprise', $entreprise);
        }
    }

    //SERVICES
    public static function services($entreprise = 0, $view) {
        $services = Service::where('entreprise_id', $entreprise)->orderBy('service')->get();
        $service = new Service();
        $entreprise = Entreprise::find($entreprise);
        return view($view)->with('service', $service)->with('services', $services)->with('entreprise', $entreprise);
    }

    public static function service($entreprise = 0, $id = 0, $view) {
        $service = Service::find($id);
        $services = Service::where('entreprise_id', $entreprise)->orderBy('service')->get();
        $entreprise = Entreprise::find($entreprise);
        if ($service == null)
            $service = new Service();
        return view($view)->with('service', $service)->with('services', $services)->with('entreprise', $entreprise);
    }

    public static function createService(Request $request, $redirect, $redirects) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('entreprise_id'), new Service(), 'service', $request->input('service'), $request->input('id', 0)))
                $error = "Service déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);

            Service::create($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function updateService(Request $request, $redirect, $redirects) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('service_id'), new Service(), 'service', $request->input('service'), $request->input('id', 0)))
                $error = "Service déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);
            $id = $request->input('id');
            Service::find($id)->update($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function deleteService($entreprise, $id, $redirect) {
        //$ids = $request->input($id);
        Service::destroy($id);
        return redirect($redirect . $entreprise);
    }

    //ADRESSES
    public static function adresses($entreprise_id = 0, $view) {
        $adresses = Adresse::with('ville')->where('entreprise_id', $entreprise_id)->orderBy('adresse')->get();
        $adresse = new Adresse();
        $entreprise = Entreprise::find($entreprise_id);
        $principale = Adresse::with('ville')->where('entreprise_id', $entreprise_id)->first();
        $villes = Ville::where('country_id', $principale->ville->country_id)->get();
        return view($view)->with('adresse', $adresse)->with('adresses', $adresses)->with('entreprise', $entreprise)->with('villes', $villes);
    }

    public static function adresse($entreprise_id = 0, $id = 0, $view) {
        $adresse = Adresse::find($id);
        $adresses = Adresse::with('ville')->where('entreprise_id', $entreprise_id)->orderBy('adresse')->get();
        $entreprise = Entreprise::find($entreprise_id);
        if ($adresse == null)
            $adresse = new Adresse();
        $principale = Adresse::with('ville')->where('entreprise_id', $entreprise_id)->first();
        $villes = Ville::where('country_id', $principale->ville->country_id)->get();
        return view($view)->with('adresse', $adresse)->with('adresses', $adresses)->with('entreprise', $entreprise)->with('villes', $villes);;
    }

    public static function createAdresse(Request $request, $redirect, $redirects) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('entreprise_id'), new Adresse(), 'adresse', $request->input('adresse'), $request->input('id', 0)))
                $error = "Adresse déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);

            Adresse::create($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function updateAdresse(Request $request, $redirect, $redirects) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('adresse_id'), new Adresse(), 'adresse', $request->input('adresse'), $request->input('id', 0)))
                $error = "Adresse déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);
            $id = $request->input('id');
            Adresse::find($id)->update($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function deleteAdresse($entreprise, $id, $redirect) {
        //$ids = $request->input($id);
        Adresse::destroy($id);
        return redirect($redirect . $entreprise);
    }

    //PRODUITS
    public static function produits($entreprise = 0, $view) {
        $produits = Produit::where('entreprise_id', $entreprise)->orderBy('produit')->get();
        $produit = new Produit();
        $entreprise = Entreprise::find($entreprise);
        $villes = Ville::orderBy('ville')->get();
        return view($view)->with('produit', $produit)->with('produits', $produits)->with('entreprise', $entreprise)->with('villes', $villes);
    }

    public static function produit($entreprise = 0, $id = 0, $view) {
        $produit = Produit::find($id);
        $produits = Produit::where('entreprise_id', $entreprise)->orderBy('produit')->get();
        $entreprise = Entreprise::find($entreprise);
        if ($produit == null)
            $produit = new Produit();
        $villes = Ville::orderBy('ville')->get();
        return view($view)->with('produit', $produit)->with('produits', $produits)->with('entreprise', $entreprise)->with('villes', $villes);
    }

    public static function createProduit(Request $request, $redirect, $redirects, $filesize) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('entreprise_id'), new Produit(), 'produit', $request->input('produit'), $request->input('id', 0)))
                $error = "Produit déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);
            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('fichier')) {
                $fileName = Help::upload('fichier', 'entreprises/produits/', $filesize, $extension);
                if ($fileName != null)
                    $request->merge(array('image' => $fileName));
            }
            Produit::create($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function updateProduit(Request $request, $redirect, $redirects, $filesize) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('produit_id'), new Produit(), 'produit', $request->input('produit'), $request->input('id', 0)))
                $error = "Produit déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);

            $id = $request->input('id');

            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('fichier')) {
                $fileName = Help::upload('fichier', 'entreprises/produits/', $filesize, $extension);
                if ($fileName != null)
                    $request->merge(array('image' => $fileName));
            }
            Produit::find($id)->update($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function deleteProduit($entreprise, $id, $redirect) {
        $produit = Produit::find($id);
        if (\File::exists('uploads/entreprises/produits/' . $produit->image))
            \File::delete('uploads/entreprises/produits/' . $produit->image);
        $produit->delete();
        return redirect($redirect . $entreprise);
    }

    //PARTENAIRES
    public static function partenaires($entreprise = 0, $view) {
        $partenaires = Partenaire::where('entreprise_id', $entreprise)->orderBy('partenaire')->get();
        $partenaire = new Partenaire();
        $entreprise = Entreprise::find($entreprise);
        $villes = Ville::orderBy('ville')->get();
        return view($view)->with('partenaire', $partenaire)->with('partenaires', $partenaires)->with('entreprise', $entreprise)->with('villes', $villes);
    }

    public static function partenaire($entreprise = 0, $id = 0, $view) {
        $partenaire = Partenaire::find($id);
        $partenaires = Partenaire::where('entreprise_id', $entreprise)->orderBy('partenaire')->get();
        $entreprise = Entreprise::find($entreprise);
        if ($partenaire == null)
            $partenaire = new Partenaire();
        $villes = Ville::orderBy('ville')->get();
        return view($view)->with('partenaire', $partenaire)->with('partenaires', $partenaires)->with('entreprise', $entreprise)->with('villes', $villes);
    }

    public static function createPartenaire(Request $request, $redirect, $redirects, $filesize) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('entreprise_id'), new Partenaire(), 'partenaire', $request->input('partenaire'), $request->input('id', 0)))
                $error = "Partenaire déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);
            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('fichier')) {
                $fileName = Help::upload('fichier', 'entreprises/partenaires/', $filesize, $extension);
                if ($fileName != null)
                    $request->merge(array('logo' => $fileName));
            }
            Partenaire::create($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function updatePartenaire(Request $request, $redirect, $redirects, $filesize) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkElementObject('entreprise_id', $request->input('partenaire_id'), new Partenaire(), 'partenaire', $request->input('partenaire'), $request->input('id', 0)))
                $error = "Partenaire déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect($redirect . $request->input('entreprise_id') . '/' . $request->input('id', 0))->withInput()->with("error", $error);

            $id = $request->input('id');

            $extension = array('png', 'gif', 'jpg', 'jpeg');

            if ($request->hasFile('fichier')) {
                $fileName = Help::upload('fichier', 'entreprises/partenaires/', $filesize, $extension);
                if ($fileName != null)
                    $request->merge(array('logo' => $fileName));
            }
            Partenaire::find($id)->update($request->all());
            return redirect($redirects . $request->input('entreprise_id'));
        }
    }

    public static function deletePartenaire($entreprise, $id, $redirect) {
        //$ids = $request->input($id);
        $partenaire = Partenaire::find($id);
        if (\File::exists('uploads/entreprises/partenaires/' . $partenaire->logo))
            \File::delete('uploads/entreprises/partenaires/' . $partenaire->logo);
        $partenaire->delete();
        return redirect($redirect . $entreprise);
    }
}