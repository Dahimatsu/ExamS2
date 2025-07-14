<section class="d-flex justify-content-center align-items-center flex-column">
    <h1>Inscrivez-vous</h1>

    <form action="traitements/traitement-index.php" class="inscription" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="date_de_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_de_naissance" name="date_de_naissance" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <select class="form-select" id="genre" name="genre" required>
                <option value="">Genre</option>
                <option value="masculin">Homme</option>
                <option value="féminin">Femme</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" name="inscription" class="btn">S'inscrire</button>
        </div>
    </form>
    <div class="mt-3">
        <p>Vous avez déjà un compte ? <a href="?page=login">Se connecter</a></p>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'email') { ?>
        <div class="alert alert-danger mt-3" role="alert">
            L'email est déjà utilisé.
        </div>
    <?php } elseif (isset($_GET['error']) && $_GET['error'] === 'password') { ?>
        <div class="alert alert-danger mt-3" role="alert">
            Les mots de passe ne correspondent pas.
        </div>
    <?php } ?>
</section>