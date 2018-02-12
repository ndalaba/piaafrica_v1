@extends('front.layout')
@section('title') @parent | Foire à question @stop
@section('content')

<section id="page-head">
    <div class="container">
        <div class="row col-md-12">
            <div class="page-heading">
                <h1>Aide</h1>
            </div>
        </div>
    </div>
</section>
        <!--Category-->
<section id="detail">
    <div class="container">
        <div class="row">
          <div class="col-md-8">
              <div class="question">
                <div class="basic-questions">
                  <h4 class="inner-heading">DÉPOSER UNE ANNONCE</h4>
                  <div class="accordion">
                      <div class="accordion-tab" id="btn1">
                          <i class="fa fa-angle-right"></i>
                          <p>Règles de diffusion</p>
                      </div>

                      <div class="accordion-content active btn1">
                          <p>Pour connaître nos règles de diffusion, les produits prohibés ainsi que les informations obligatoires à fournir, cliquez <a class="col" href="{{url('regles-generales')}}">ici</a>.</p>
                      </div>

                      <div class="accordion-tab" id="btn2">
                          <i class="fa fa-angle-right"></i>
                          <p>Comment publier une annonce ?</p>
                      </div>
                      <div class="accordion-content btn2">
                          <p>Pour publier une annonce, rien de plus facile. Cliquez sur «Publier une annonce », puis renseignez le formulaire en respectant bien les informations qui y sont mentionnées. La région à choisir est celle dans laquelle votre bien est à vendre. D'autre part, choisissez avec soin le titre et le descriptif de votre annonce pour ainsi optimiser votre vente. Pour terminer, une annonce avec photos est 7 fois plus consultée qu'une annonce sans photo, alors n'hésitez pas à rendre votre annonce attrayante. Une fois que vous aurez validé ces informations, vous pourrez modifier ou supprimer votre annonce dans votre espace membre en vous connectant.</p>
                      </div>

                      <div class="accordion-tab" id="btn3">
                          <i class="fa fa-angle-right"></i>
                          <p>Combien coûte le dépôt d'une annonce sur Maakiti.com ?</p>
                      </div>
                      <div class="accordion-content btn3">
                          <p>Déposer une annonce sur Maakiti.com est TOTALEMENT GRATUIT .</p>
                      </div>

                      <div class="accordion-tab" id="btn4">
                          <i class="fa fa-angle-right"></i>
                          <p>Combien de temps mon annonce reste-t-elle en ligne ?</p>
                      </div>
                      <div class="accordion-content btn4">
                          <p>Votre annonce restera deux mois en ligne, période durant laquelle vous pouvez vous-même la supprimer. A l'issue de cette période, elle sera automatiquement supprimée.
                                La souscription à une option payante (Annonce A la Une) prolongera la durée de votre annonce sur le site à 3 mois.</p>
                      </div>

                      <div class="accordion-tab" id="btn5">
                          <i class="fa fa-angle-right"></i>
                          <p>Dans quelle région diffuser mon annonce ?</p>
                      </div>
                      <div class="accordion-content btn5">
                          <p>Vous devez diffuser votre annonce dans la région dans laquelle votre bien est à vendre.</p>
                      </div>

                      <div class="accordion-tab" id="btn6">
                          <i class="fa fa-angle-right"></i>
                          <p>Que mettre dans le texte de mon annonce ?</p>
                      </div>
                      <div class="accordion-content btn6">
                          <p>Dans le texte de votre annonce, décrivez votre produit du mieux possible, afin que l'internaute ait un maximum de détails. Pour que votre annonce ne soit pas refusée, respectez bien les règles de diffusion de chaque catégorie de produit.</p>
                      </div>
                      <div class="accordion-tab" id="btn7">
                          <i class="fa fa-angle-right"></i>
                          <p>Dois-je faire figurer mon adresse email dans le texte de mon annonce ?</p>
                      </div>
                      <div class="accordion-content btn7">
                          <p>Pour vous éviter d'être l'objet de spam (emails et publicités indésirables), nous ne faisons pas apparaître votre adresse email en clair sur le site et nous vous conseillons de ne pas la faire figurer dans le texte de votre annonce. Pour vous contacter, les utilisateurs du site peuvent utiliser le formulaire de réponse que nous mettons à leur disposition, dans lequel votre adresse n'est pas visible.</p>
                      </div>

                      <div class="accordion-tab" id="btn8">
                          <i class="fa fa-angle-right"></i>
                          <p>Comment insérer des photos dans mon annonce ?</p>
                      </div>
                      <div class="accordion-content btn8">
                          <p>à l'aide du bouton «Parcourir » qui se trouve dans le formulaire de dépôt d'annonce, vous pouvez ajouter jusqu'à 3 photos. Les photos doivent être au format GIF, BMP, PNG ou JPEG.</p>
                      </div>
                      <div class="accordion-tab" id="btn9">
                          <i class="fa fa-angle-right"></i>
                          <p>Puis-je ajouter un lien vers un site internet dans mon annonce ?</p>
                      </div>
                      <div class="accordion-content btn9">
                          <p>Dans le formulaire de dépôt d'annonce, il est possible d'ajouter un lien vers une autre page web. Ce lien doit diriger vers une page contenant davantage d'informations sur le produit ou service que vous proposez, que ce soit une page personnelle ou le site du fabricant du produit. Le lien ne peut donc pas diriger vers une page web n'ayant aucun lien avec le produit, ni vers le site d'une entreprise autre que le fabricant, ni vers une page d'annonces d'un site concurrent.</p>
                      </div>
                      <div class="accordion-tab" id="btn10">
                          <i class="fa fa-angle-right"></i>
                          <p>Puis-je utiliser du code ou des étiquettes HTML dans mon annonce ?</p>
                      </div>
                      <div class="accordion-content btn10">
                          <p>Non, il est impossible d'utiliser du code HTML. Celui-ci sera automatiquement effacé. Cependant, si vous souhaitez ajouter des photos, il vous suffit d'utiliser les champs appropriés dans le formulaire.</p>
                      </div>
                      <div class="accordion-tab" id="btn11">
                          <i class="fa fa-angle-right"></i>
                          <p>Quand je clique sur «Précédent» dans mon navigateur pour modifier mon annonce, le formulaire est vide ?</p>
                      </div>
                      <div class="accordion-content btn11">
                          <p>Cela se produit parfois avec certains navigateurs. Si vous cliquez à nouveau sur «Précédent » puis sur «Suivant », votre texte va sans doute réapparaître dans le formulaire.</p>
                      </div>
                      <div class="accordion-tab" id="btn12">
                          <i class="fa fa-angle-right"></i>
                          <p>Pourquoi dois-je donner mon numéro de téléphone ?</p>
                      </div>
                      <div class="accordion-content btn12">
                          <p>Même si vous choisissez de ne pas afficher votre numéro de téléphone, nous vous le demandons au cas où nous aurions besoin de vous contacter, par exemple, si vous perdez votre mot de passe ou si votre adresse email ne fonctionne pas.</p>
                      </div>
                      <div class="accordion-tab" id="btn13">
                          <i class="fa fa-angle-right"></i>
                          <p>Dois-je m'inscrire pour utiliser Maakiti.com ?</p>
                      </div>
                      <div class="accordion-content btn13">
                          <p>Pour déposer une annonce sur maakiti.com vous dever être inscrit sur le site.
                            Par contre pour contacter un vendeur vous n'avez pas besoin d'être inscrit. </p>
                      </div>

                  </div>
                </div>
                <div class="question">
                      <div class="other-question">
                          <h4 class="inner-heading">Gérer mes annonces</h4>
                          <div class="accordion">
                              <div class="accordion-tab" id="btn-1">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Comment retrouver mon annonce ?</p>
                              </div>

                              <div class="accordion-content active btn-1">
                                  <p>Pour retrouver votre annonce, cliquez sur le lien contenu dans l'email que vous avez reçu lors de la mise en ligne de votre annonce.
                                    <br>
                                    Vous pouvez également retrouver toutes vos annonces en vous connectant à votre compte personnel. Pour cela utiliser l'adresse email et le mot de passe renseignés lors de votre dépôt.</p>
                              </div>

                              <div class="accordion-tab" id="btn-2">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Comment modifier mon annonce ?</p>
                              </div>
                              <div class="accordion-content btn-2">
                                  <p>Dans votre espace membre, cliquer devant l'annonce sur l'icone <i class"fa fa-pencil"></i>de modification</p>
                              </div>

                              <div class="accordion-tab" id="btn-3">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Comment dépublier/publier ou supprimer mon annonce ?</p>
                              </div>
                              <div class="accordion-content btn-3">
                                  <p>Dans votre espace membre. Cochez les annonces pour les quelles vous voulez effectuer cette opération. Sélectionner l'opération que vous voulez effectuer et exécuter </p>
                              </div>

                              <div class="accordion-tab" id="btn-4">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Comment mettre mon annonce «A la Une » ?</p>
                              </div>
                              <div class="accordion-content btn-4">
                                  <p>L'option « A la Une » met en avant votre annonce sur la page d'accueil et sur plusieurs autres pages dans un emplacement privilégié , pendant 7 ou 30 jours.
                                      L'affichage de votre annonce dans cet emplacement est aléatoire et fonction du volume d'autres annonces bénéficiant de cette même option.
                                      Vous pouvez acheter l'option « A la Une  » en voyant un message à l'administrateur du site. N'oubliez pas qu'il est obligatoire d'avoir au moins une photo sur votre annonce pour pouvoir bénéficier de l'option « A la Une ».</p>
                              </div>

                              <div class="accordion-tab" id="btn-5">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Que faire si j'ai oublié mon mot de passe ?</p>
                              </div>
                              <div class="accordion-content btn-5">
                                  <p>Sur la page de connexion , cliquez sur le lien «mot de passe oublié ». Votre mot de passe vous sera alors envoyé à l'adresse email indiquée lors du dépôt d'annonce.</p>
                              </div>

                              <div class="accordion-tab" id="btn-6">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Pourquoi mon annonce est-elle toujours visible alors que je l'ai supprimée ?</p>
                              </div>
                              <div class="accordion-content btn-6">
                                  <p>Quelques minutes sont nécessaires entre le moment oû vous demandez la suppression de votre annonce et où celle-ci est effective. Si vous continuez malgré tout à voir votre annonce, il est probable que la page de votre annonce soit conservée dans le cache de votre navigateur.
                                  </p>
                              </div>
                              <div class="accordion-tab" id="btn-7">
                                  <i class="fa fa-angle-right"></i>
                                  <p>Comment répondre à une annonce par email ?</p>
                              </div>
                              <div class="accordion-content btn-7">
                                  <p>Pour contacter un annonceur par email, rendez-vous sur la page de l'annonce et renseigner le formulaire de contact de l'annonceur situer à droite de l'annonce.
                                  </p>
                              </div>

                          </div>
                      </div>
                  </div>
                <div class="question">
                    <div class="other-question">
                        <h4 class="inner-heading">Fraude</h4>
                        <div class="accordion">
                            <div class="accordion-tab" id="btn_1">
                                <i class="fa fa-angle-right"></i>
                                <p>Que faire en cas d'annonce frauduleuse ?</p>
                            </div>

                            <div class="accordion-content active btn_1">
                                <p>Si une annonce vous paraît frauduleuse, envoyer nous un message en precisant l'ID de l'annonce .</p>
                            </div>

                            <div class="accordion-tab" id="btn_2">
                                <i class="fa fa-angle-right"></i>
                                <p>Que faire en cas d'email douteux ?</p>
                            </div>
                            <div class="accordion-content btn_2">
                                <p>Méfiez-vous. Si vous recevez des emails en mauvais français ou en anglais vous demandant des coordonnées personnelles, bancaires ou des acomptes, n'y répondez pas ! Il s'agit certainement d'une fraude. </p>
                            </div>

                            <div class="accordion-tab" id="btn_3">
                                <i class="fa fa-angle-right"></i>
                                <p>Faut-il accepter les transactions qui ne se font pas en main propre ?</p>
                            </div>
                            <div class="accordion-content btn_3">
                                <p>Maakiti.com est un site d'annonces de proximité. Nous vous recommandons toujours de privilégier la remise de l'objet en main propre. Cela évite les mauvaises surprises à la fois pour l'acheteur et le vendeur. La transaction s'effectue en effet directement entre acheteur et vendeur, Maakiti.com ne garantissant pas la transaction. Si cela n'est pas possible.Dans tous les cas, soyez vigilants avec des acheteurs vous contactant depuis l'étranger et vous proposant des virements par Western Union ou Mandat Cash.</p>
                            </div>

                            <div class="accordion-tab" id="btn_4">
                                <i class="fa fa-angle-right"></i>
                                <p>Maakiti.com peut-il se porter garant d'une transaction entre un acheteur et un vendeur ?</p>
                            </div>
                            <div class="accordion-content btn_4">
                                <p>Nous n'intervenons en aucun cas comme intermédiaire ou tiers de confiance dans les transactions entre acheteurs et vendeurs. Refusez systématiquement tout versement d'argent qui vous serait demandé au nom de notre site.
                                  </p>
                            </div>

                            <div class="accordion-tab" id="btn_5">
                                <i class="fa fa-angle-right"></i>
                                <p>Le prix d'un produit me paraît particulièrement faible, faut-il se méfier ?</p>
                            </div>
                            <div class="accordion-content btn_5">
                                <p>Méfiez-vous des propositions trop alléchantes et des prix trop bas. Ne payez jamais à l'avance un vendeur que vous ne connaissez pas (ne versez pas d'acompte). En cas de doute, envoyer nous un message en precisant l'ID de l'annonce.</p>
                            </div>

                        </div>
                    </div>
                </div>
              </div>
          </div>
          @include('front.inc.sidebar')
        </div>
    </div>
</section><!--end advertisement-->
  @include('front.inc.largepub')
@stop
