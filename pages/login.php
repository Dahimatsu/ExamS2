<section class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class ="login">
        <h1 class="text-center">Connectez-vous</h1>
        <form action="traitements/traitement-index.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="seConnecter" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <div class="mt-3 text-center">
            <p>Vous n'avez pas de compte ? <a href="?page=inscription">S'inscrire</a></p>
        </div>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid') { ?>
            <div class="alert alert-danger mt-2" role="alert">
                Identifiant ou mot de passe incorrect.
            </div>
        <?php } ?>
    </div>
</section>