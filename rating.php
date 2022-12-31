<?php 
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
    include './fun/utility.php';

    /* pagina di tutti i servizi */
    session_start();

    include './template/head.php';
    include './template/header.php';

?>
<main>
    <?php if(!CheckRatingByCfService($_SESSION['CF'],'16')){ ?>
        <div id="risultato-rating" class="text-center">Votazione inviata correttamente.</div>
        <div class="rating-box" id="rating-box">
            <div class="feed_title">Quanto è stato facile usare questo servizio?</div>
            <div id="tutorial">
                <input type="hidden" name="userCf" id="userCf" value="<?php echo $_SESSION['CF']; ?>" />
                <input type="hidden" name="ServizioId" id="ServizioId" value="16" />
                <input type="hidden" name="PraticaId" id="PraticaId" value="6" />
                <input type="hidden" name="rating" id="rating" value="" />
                <ul>
                    <?php
                    $i = 0;
                    for ($i = 0; $i <= 4; $i ++) {
                        echo '<li id="star-'.$i.'" onmouseover="highlightStar('.$i.');" onClick="addRating('.$i.');">&#9733;</li>';
                    }
                    ?>
                    <div id="loader-icon">
                        <img src="./media/images/loader.gif" id="image-size" />
                    </div>
                </ul>
            </div>
        </div>
        <div id="valutazione_positiva" class="hide">
            <div class="feed_title">Quali sono stati gli aspetti che hai preferito?</div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="positiva" id="positiva1" value="1" />
                    <label class="form-check-label" for="positiva1">Le indicazioni erano chiare;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="positiva" id="positiva2" value="2" />
                    <label class="form-check-label" for="positiva2">Le indicazioni erano complete;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="positiva" id="positiva3" value="3" />
                    <label class="form-check-label" for="positiva3">Capivo sempre che stavo procedendo correttamente;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="positiva" id="positiva4" value="4" />
                    <label class="form-check-label" for="positiva4">Non ho avuto problemi tecnici;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="positiva" id="positiva5" value="5" />
                    <label class="form-check-label" for="positiva5">Altro.</label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" id="commento_positivo_txt">
                        <textarea id="commento_positivo" name="commento_positivo" rows="4" placeholder="Breve commento"></textarea>
                    </label>
                </div>
                <button type="button" id="btn_invia_feedback_positivo" name="btn_invia_feedback_positivo" class="btn btn-primary">Invia Feedback <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
            </div>
        </div>
        <div id="valutazione_negativa" class="hide">
            <div class="feed_title">Dove hai incontrato le maggiori difficoltà?</div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="negativa" id="negativa1" value="1" />
                    <label class="form-check-label" for="negativa1">A volte le indicazioni non erano chiare;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="negativa" id="negativa2" value="2" />
                    <label class="form-check-label" for="negativa2">A volte le indicazioni non erano complete;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="negativa" id="negativa3" value="3" />
                    <label class="form-check-label" for="negativa3">A volte non capivo se stavo procedendo correttamente;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="negativa" id="negativa4" value="4" />
                    <label class="form-check-label" for="negativa4">Ho avuto problemi tecnici;</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="negativa" id="negativa5" value="5" />
                    <label class="form-check-label" for="negativa5">Altro.</label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" id="commento_negativo_txt">
                        <textarea id="commento_negativo" name="commento_negativo" rows="4" placeholder="Breve commento"></textarea>
                    </label>
                </div>
                <button type="button" id="btn_invia_feedback_negativo" name="btn_invia_feedback_negativo" class="btn btn-primary">Invia Feedback <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
            </div>
        </div>
    <?php } ?>
</main>
<?php include './template/footer.php'; 
