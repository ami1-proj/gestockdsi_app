<?php

use App\User;
use App\TypeArticle;
use App\Affectation;
use App\Article;
use App\Fournisseur;
use App\Employe;
use App\Departement;
use App\MarqueArticle;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});


/**
 * [Breadcrumbs Utilisateurs]
 *
 */
// Home > Utilisateurs
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Utilisateurs', route('users.index'));
});

// Home > Utilisateurs > Nouveau
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push('Nouveau', route('users.create'));
});

// Home > Utilisateurs > [User]
Breadcrumbs::for('users.show', function ($trail, $id) {
    $user = User::findOrFail($id);
    $trail->parent('users');
    $trail->push($user->name, route('users.show', $user));
});

// Home > Utilisateurs > [User] > Modification
Breadcrumbs::for('users.edit', function ($trail, $id) {
    $user = User::findOrFail($id);
    $trail->parent('users.show', $id);
    $trail->push('Modification', route('users.edit', $user));
});


/**
 * [Breadcrumbs Roles]
 *
 */
// Home > Roles
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});

// Home > Roles > Nouveau
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles');
    $trail->push('Nouveau', route('roles.create'));
});

// Home > Roles > [Role]
Breadcrumbs::for('roles.show', function ($trail, $id) {
    $role = Role::findOrFail($id);
    $trail->parent('roles');
    $trail->push($role->name, route('roles.show', $role));
});

// Home > Roles > [Role] > Modification
Breadcrumbs::for('roles.edit', function ($trail, $id) {
    $role = Role::findOrFail($id);
    $trail->parent('roles.show', $id);
    $trail->push('Modification', route('roles.edit', $role));
});

/**
 * [Breadcrumbs Types Article]
 *
 */
// Home > Types Article
Breadcrumbs::for('typearticles', function ($trail) {
    $trail->parent('home');
    $trail->push('Types Article', route('typearticles.index'));
});

// Home > Types Article > Nouveau
Breadcrumbs::for('typearticles.create', function ($trail) {
    $trail->parent('typearticles');
    $trail->push('Nouveau', route('typearticles.create'));
});

// Home > Types Article > [TypeArticle]
Breadcrumbs::for('typearticles.show', function ($trail, $id) {
    $typearticle = TypeArticle::findOrFail($id);
    $trail->parent('typearticles');
    $trail->push($typearticle->libelle, route('typearticles.show', $typearticle));
});

// Home > Types Article > [TypeArticle] > Modification
Breadcrumbs::for('typearticles.edit', function ($trail, $id) {
    $typearticle = TypeArticle::findOrFail($id);
    $trail->parent('typearticles.show', $id);
    $trail->push('Modification', route('typearticles.edit', $typearticle));
});

/**
 * [Breadcrumbs Articles]
 *
 */
// Home > Articles
Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('home');
    $trail->push('Articles', route('articles.index'));
});

// Home > Articles > Nouveau
Breadcrumbs::for('articles.create', function ($trail) {
    $trail->parent('articles');
    $trail->push('Nouveau', route('articles.create'));
});

// Home > Articles > [Article]
Breadcrumbs::for('articles.show', function ($trail, $id) {
    $article = Article::findOrFail($id);
    $trail->parent('articles');
    $trail->push($article->referenceComplete, route('articles.show', $article));
});

// Home > Articles > [Article] > Modification
Breadcrumbs::for('articles.edit', function ($trail, $id) {
    $article = Article::findOrFail($id);
    $trail->parent('articles.show', $id);
    $trail->push('Modification', route('articles.edit', $article));
});


/**
 * [Breadcrumbs Employes]
 *
 */
// Home > Employes
Breadcrumbs::for('employes', function ($trail) {
    $trail->parent('home');
    $trail->push('Employes', route('employes.index'));
});

// Home > Employes > Nouveau
Breadcrumbs::for('employes.create', function ($trail) {
    $trail->parent('employes');
    $trail->push('Nouveau', route('employes.create'));
});

// Home > Employes > [Employe]
Breadcrumbs::for('employes.show', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes');
    $trail->push($employe->nom_complet, route('employes.show', $employe));
});

// Home > Employes > [Employe] > Modification
Breadcrumbs::for('employes.edit', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.show', $id);
    $trail->push('Modification', route('employes.edit', $employe));
});

// Home > Employes > [Employe] > Modification > e-mails
Breadcrumbs::for('employes.emails', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.edit', $id);
    $trail->push('e-mails');
});

// Home > Employes > [Employe] > Modification > Telephones
Breadcrumbs::for('employes.phonenums', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.edit', $id);
    $trail->push('Telephones');
});

// Home > Employes > [Employe] > Nouvelle Affectation
Breadcrumbs::for('employes.affectation.create', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.show', $id);
    $trail->push('Nouvelle Affectation', route('affectations.elemcreate',['Employe', $employe->id]));
});

// Home > Employes > [Employe] > Modification Affectation
Breadcrumbs::for('employes.affectation.edit', function ($trail, $emp_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('employes.show', $emp_id);
    $trail->push('Modification Affectation', route('affectations.edit', $aff_id));
});

// Home > Employes > [Employe] > Détails Affectation
Breadcrumbs::for('employes.affectation.show', function ($trail, $emp_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('employes.show', $emp_id);
    $trail->push('Détails Affectation: ' . $aff->objet, route('affectations.show', $aff_id));
});


/**
 * [Breadcrumbs Departements]
 *
 */
// Home > Departements
Breadcrumbs::for('departements', function ($trail) {
    $trail->parent('home');
    $trail->push('Departements', route('departements.index'));
});

// Home > Departements > Nouveau
Breadcrumbs::for('departements.create', function ($trail) {
    $trail->parent('departements');
    $trail->push('Nouveau', route('departements.create'));
});

// Home > Departements > [Departement]
Breadcrumbs::for('departements.show', function ($trail, $id) {
    $departement = Departement::findOrFail($id);
    $trail->parent('departements');
    $trail->push($departement->intitule, route('departements.show', $departement));
});

// Home > Departements > [Departement] > Modification
Breadcrumbs::for('departements.edit', function ($trail, $id) {
    $departement = Departement::findOrFail($id);
    $trail->parent('departements.show', $id);
    $trail->push('Modification', route('departements.edit', $departement));
});

// Home > Departements > [Departement] > Nouvelle Affectation
Breadcrumbs::for('departements.affectation.create', function ($trail, $id) {
    $departement = Departement::findOrFail($id);
    $trail->parent('departements.show', $id);
    $trail->push('Nouvelle Affectation', route('affectations.elemcreate',['Departement', $departement->id]));
});

// Home > Departements > [Departement] > Modification Affectation
Breadcrumbs::for('departements.affectation.edit', function ($trail, $emp_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('departements.show', $emp_id);
    $trail->push('Modification Affectation', route('affectations.edit', $aff_id));
});

// Home > Departements > [Departement] > Détails Affectation
Breadcrumbs::for('departements.affectation.show', function ($trail, $emp_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('departements.show', $emp_id);
    $trail->push('Détails Affectation: ' . $aff->objet, route('affectations.show', $aff_id));
});


/**
 * [Breadcrumbs Fournisseurs]
 *
 */
// Home > Fournisseurs
Breadcrumbs::for('fournisseurs', function ($trail) {
    $trail->parent('home');
    $trail->push('Fournisseurs', route('fournisseurs.index'));
});

// Home > Fournisseurs > Nouveau
Breadcrumbs::for('fournisseurs.create', function ($trail) {
    $trail->parent('fournisseurs');
    $trail->push('Nouveau', route('fournisseurs.create'));
});

// Home > Fournisseurs > [Fournisseur]
Breadcrumbs::for('fournisseurs.show', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs');
    $trail->push($fournisseur->raison_sociale, route('fournisseurs.show', $fournisseur->id));
});

// Home > Fournisseurs > [Fournisseur] > Modification
Breadcrumbs::for('fournisseurs.edit', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs.show', $id);
    $trail->push('Modification', route('fournisseurs.edit', $fournisseur));
});

// Home > Fournisseurs > [Fournisseur] > Modification > e-mails
Breadcrumbs::for('fournisseurs.emails', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs.edit', $id);
    $trail->push('e-mails');
});

// Home > Fournisseurs > [Fournisseur] > Modification > Telephones
Breadcrumbs::for('fournisseurs.phonenums', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs.edit', $id);
    $trail->push('Telephones');
});


/**
 * [Breadcrumbs Marques]
 *
 */
// Home > Marques
Breadcrumbs::for('marquearticles', function ($trail) {
    $trail->parent('home');
    $trail->push('Marques', route('marquearticles.index'));
});

// Home > Marques > Nouveau
Breadcrumbs::for('marquearticles.create', function ($trail) {
    $trail->parent('marquearticles');
    $trail->push('Nouveau', route('marquearticles.create'));
});

// Home > Marques > [Marque]
Breadcrumbs::for('marquearticles.show', function ($trail, $id) {
    $marquearticle = MarqueArticle::findOrFail($id);
    $trail->parent('marquearticles');
    $trail->push($marquearticle->nom, route('marquearticles.show', $marquearticle->id));
});

// Home > Marques > [Marque] > Modification
Breadcrumbs::for('marquearticles.edit', function ($trail, $id) {
    $marquearticle = MarqueArticle::findOrFail($id);
    $trail->parent('marquearticles.show', $id);
    $trail->push('Modification', route('marquearticles.edit', $marquearticle));
});

