<?php 
    /* file di inclusione */
    $configData = require '../env/config_servizi.php';
    $configDB = require '../env/config.php';
    include '../fun/utility.php';

    /* pagina iniziale */
    session_start();

    include '../template/head_servizi.php';
    include '../template/header_servizi.php';
    
    /* con l'id vado a richiamare i dati salvati */
    if(isset($_GET["pratican"]) && $_GET["pratican"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["pratican"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $cf = $row["richiedenteCf"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = date("d/m/Y", strtotime($row["richiedenteDataNascita"]));
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];

                $ConcorsoId = $row["ConcorsoId"];
                $Concorso = ConcorsoById($row["ConcorsoId"]);
                
                $cittadinoItaliano = $row["cittadinoItaliano"];
                $cittadinoEuropeo = $row["cittadinoEuropeo"];
                $statoEuropeo = $row["statoEuropeo"];
                $conoscenzaLingua = $row["conoscenzaLingua"];
                $idoneitaFisica = $row["idoneitaFisica"];
                $dirittiCiviliPolitici = $row["dirittiCiviliPolitici"];
                $destituzionePA = $row["destituzionePA"];
                $fedinaPulita = $row["fedinaPulita"];
                $condanne = $row["condanne"];
                $obbligoLeva = $row["obbligoLeva"];
                $titoloStudio = $row["titoloStudio"];
                $titoloStudioScuola = $row["titoloStudioScuola"];
                $titoloStudioData = date("d/m/Y", strtotime($row["titoloStudioData"]));
                $titoloStudioVoto = $row["titoloStudioVoto"];
                $conoscenzaInformatica = $row["conoscenzaInformatica"];
                $conoscenzaLinguaEstera = $row["conoscenzaLinguaEstera"];
                $titoliPreferenza = $row["titoliPreferenza"];
                $necessitaHandicap = $row["necessitaHandicap"];
                $dirittoRiserva = $row["dirittoRiserva"];
                $accettazioneCondizioniBando = $row["accettazioneCondizioniBando"];
                $accettazioneDisposizioniComune = $row["accettazioneDisposizioniComune"];
                $accettazioneComunicazioneVariazioniDomicilio = $row["accettazioneComunicazioneVariazioniDomicilio"];

                if($row["uploadCartaIdentitaFronte"] != ''){
                    $uploadCartaIdentitaFronte = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaFronte"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCartaIdentitaFronteSaved = $row["uploadCartaIdentitaFronte"];
                }
                if($row["uploadCartaIdentitaRetro"] != ''){
                    $uploadCartaIdentitaRetro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaRetro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCartaIdentitaRetroSaved = $row["uploadCartaIdentitaRetro"];
                }
                if($row["uploadCV"] != ''){
                    $uploadCV = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCV"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCVSaved = $row["uploadCV"];
                }
                
                if($row["uploadTitoliPreferenza"] != ''){
                    $tmpUploadTitoliPreferenza1 = substr($row["uploadTitoliPreferenza"],0,-1);
                    $tmpUploadTitoliPreferenzas = explode(';', $tmpUploadTitoliPreferenza1);
                    $uploadTitoliPreferenza = "";
                    foreach($tmpUploadTitoliPreferenzas as $tmpUploadTitoliPreferenza) {
                        $uploadTitoliPreferenza .= "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $tmpUploadTitoliPreferenza ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    }
                    $uploadTitoliPreferenzaSaved = $row["uploadTitoliPreferenza"];
                }else{
                    $uploadTitoliPreferenza = '';
                }
            }
        }
        $connessione->close();
    }
?>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb p-0" data-element="breadcrumb">
                                <li class="breadcrumb-item"><a href="../bacheca.php">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page"><span class="separator">/</span><a href="../servizi_list.php">Servizi</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda per un contributo</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge"><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></h1>
                        <p class="subtitle-small">CF: <?php echo $_SESSION['CF']; ?></p>
                    </div>
                </div>
                <?php echo ViewMenuPratiche(3); ?>
            </div>
            
            <div class="it-page-sections-container">
                <div class="row">
                    <div class="col-12 col-xl-3 d-xl-block mb-4 d-none">
                        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" data-bs-navscroll>
                                <div class="navbar-custom" id="navbarNavProgress">
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <span class="accordion-header" id="accordion-title-one">
                                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                            INDICE DELLA PAGINA
                                                        </button>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                        <div class="accordion-body">
                                                            <ul class="link-list" data-element="page-index">
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pc_richiedente">
                                                                        <span class="title-medium">Richiedente</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pc_concorso">
                                                                        <span class="title-medium">Concorso</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pc_dichiarazioni">
                                                                        <span class="title-medium">Dichiarazioni</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pc_allegati">
                                                                        <span class="title-medium">Allegati</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pc_dichiarazione">
                                                                        <span class="title-medium">Dichiarazione Finale</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-xl-9 body-dichiarazioni after-section">
                        <div class="it-page-section mb-30" id="pc_richiedente">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Richiedente</h2>
                                            <p><b>Informazioni su di te</b></p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5><b><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></b></h5>
                                        <p class="subtitle-small">Codice Fiscale:<br/><b><?php echo $_SESSION['CF']; ?></b></p>

                                        <div class="accordion-item">
                                            <div class="row">
                                                <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Nome <b><?php echo $nome; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Cognome <b><?php echo $cognome; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Codice Fiscale <b><?php echo $cf; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Data di Nascita <b><?php echo $datanascita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Luogo di Nascita <b><?php echo $luogonascita; ?></b></p></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Localit?? <b><?php echo $richiedenteLocalita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Provincia <b><?php echo $richiedenteProvincia; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Via e Numero civico <b><?php echo $richiedenteVia; ?></b></p></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>E-mail <b><?php echo $email; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Telefono <b><?php echo $richiedenteTel; ?></b></p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="pc_concorso">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Concorso</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="m-0"><?php echo $Concorso; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="pc_dichiarazioni">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Dichiarazioni</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" id="pc_pnl_dichiarazioni">
                                        <div class="row mb-30">
                                            <div class="col-lg-12">
                                                di essere cittadino/a 
                                                <?php if($cittadinoItaliano == 1){ ?>
                                                    italiano/a
                                                <?php }else{ ?>
                                                    <?php if($cittadinoEuropeo == 1){ ?>
                                                        europeo (<?php echo $statoEuropeo; ?>)
                                                    <?php }
                                                } ?>
                                                
                                                <?php if($conoscenzaLingua == 1){ ?>
                                                    e di conoscere la lingua italiana
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php if( $idoneitaFisica == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di essere fisicamente idoneo/a all???impiego
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $dirittiCiviliPolitici == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di godere dei diritti civili e politici
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $destituzionePA == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di non essere stato destituito, dispensato o comunque licenziato dall???impiego presso una pubblica amministrazione per persistente insufficiente rendimento e di non essere stato dichiarato decaduto o licenziato da altro pubblico impiego per averlo conseguito mediante esibizione di documenti falsi o viziati da invalidit?? non sanabile (art.127 DPR 10/01/1957 n.3)
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $fedinaPulita == 1 && $condanne <> ""){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    <?php if( $fedinaPulita == 1){ ?>
                                                        di non aver riportato condanne penali e di non aver procedimenti penali pendenti a proprio carico che impediscano, ai sensi delle vigenti disposizioni in materia, la costituzione del rapporto d???impiego con la Pubblica Amministrazione
                                                    <?php }else{ ?>
                                                        di aver riportato le seguenti condanne (anche se sia concessa amnistia, condono indulto o perdono giudiziale) o di avere seguenti procedimenti penali in corso:<br>
                                                        <?php echo $condanne; ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $obbligoLeva == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di essere in regola nei confronti dell???obbligo di leva per i candidati di sesso maschile nati entro il 31/12/1985 ai sensi dell???art.1, Legge 23/8/2004, n.226
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $titoloStudio != ""){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di essere in possesso del seguente titolo di studio <b><?php echo $titoloStudio; ?></b> conseguito presso <b><?php echo $titoloStudioScuola; ?></b> il <b><?php echo $titoloStudioData; ?></b> con votazione finale di <b><?php echo $titoloStudioVoto; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $conoscenzaInformatica == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di conoscere l???uso delle apparecchiature, delle applicazioni informatiche pi?? diffuse e di scegliere la seguente lingua straniera <b><?php echo $conoscenzaLinguaEstera; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $titoliPreferenza != ""){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di essere in possesso dei seguenti titoli di preferenza (a parit?? di valutazione) <b><?php echo $titoliPreferenza; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>                                        
                                        <?php if( $dirittoRiserva == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di aver diritto alla riserva ai sensi dell???art1014 e dell???art. 678, comma 9, del D.Lgs66/2010
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($accettazioneCondizioniBando == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di accettare espressamente ed incondizionatamente tutte le prescrizioni e condizioni contenute nel bando di concorso
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($accettazioneDisposizioniComune == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di accettare, in caso di presa di servizio, tutte le disposizioni che regolano lo stato giuridico ed economici dei dipendenti del Comune di <?php echo $configData['nome_comune']; ?>.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($accettazioneComunicazioneVariazioniDomicilio == 1){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    di impegnarsi a comunicare, per iscritto, al Comune di <?php echo $configData['nome_comune']; ?> le eventuali successive variazioni di domicilio e riconosce che il Comune sar?? esonerato da ogni responsabilit?? in caso di irreperibilit?? del destinatario o disguidi del servizio postale e/o telematico.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if( $necessitaHandicap != ""){ ?>
                                            <div class="row mb-30">
                                                <div class="col-lg-12">
                                                    <b>Per i portatori di handicap:</b> indicare le necessit??, per l???effettuazione delle prove, in relazione al proprio handicap, di eventuali tempi aggiuntivi e/o ausili specifici ai sensi dell???art. 20, comma 2 della L. 5.02.1992, n. 104 e dell???art. 16 della legge 68/99 10) di aver diritto alla riserva ai sensi dell???art1014 e dell???art. 678, comma 9, del D.Lgs66/2010<br><br>
                                                    <b><?php echo $necessitaHandicap; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="dc_allegati">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Allegati</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>Documento di identit?? (fronte)</h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="pc_uploadCartaIdentitaFronte_file">
                                                            <?php echo $uploadCartaIdentitaFronte; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>Documento di identit?? (retro)</h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="dc_uploadCartaIdentitaRetro_file">
                                                            <?php echo $uploadCartaIdentitaRetro; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>Curriculum Vitae</h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="pc_uploadCV_file">
                                                            <?php echo $uploadCV; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($uploadTitoliPreferenza != ''){ ?>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-8 mb-3">
                                                            <h6>Titoli di precedenza o preferenza</h6>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="upload-file-list" id="dc_uploadTitoliPreferenza_file">
                                                                <?php echo $uploadTitoliPreferenza; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" id="pc_dichiarazione">
                    <div class="col-xl-9 offset-xl-3">
                        <div class="it-page-section mb-30">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-body">
                                        <p>Il/la sottoscritto/a dichiara ai sensi dell???art. 76 del D.P.R. 445 del 28/12/2000, di essere a conoscenza delle responsabilit?? penali cui pu?? andare incontro in caso di dichiarazioni mendaci.<br>
                                        (Le dichiarazioni sopra riportate sostituiscono a tutti gli effetti le corrispondenti certificazioni ai sensi dell???art.46 D.P.R. 445 del 28.12.2000)</p>
                                        <p>Il/la sottoscritto/a autorizza ai sensi dell???art. 23 del D. Lgs. 196 del 30.06.2003 e del Regolamento(UE) 2016/679, il Comune di <?php echo $configData['nome_comune']; ?> al trattamento dei propri dati sia personali che eventualmente sensibili ai soli fini del presente procedimento concorsuale e dell???eventuale assunzione, qualora assunto in servizio.</p>
                                        <p><b>Cliccando su "Conferma e invia" confermi di aver preso visione dei termini e delle condizioni di servizio sopra elencate.</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="divButtons" class="float-right mr-lg-40">
                            <a class="btn btn-default" href="compilazione_dati.php"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a>
                            <form method="POST" action="#" name="pc_conferma_invia" id="pc_conferma_invia" class="display-inline">
                                <input type="hidden" name="pratican" id="pratican" value="<?php echo $_GET['pratican']; ?>" />
                                <button type="button" class="btn btn-primary">Conferma e invia <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" tabindex="-1" role="dialog" id="ElaborazioneRichiestaModal" aria-labelledby="ElaborazioneRichiestaTitle">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="ElaborazioneRichiestaTitle">Salvataggio della richiesta in corso</h2>
                </div>
                <div class="modal-body mb-30">
                    <p>Stiamo elaborando la tua richiesta.</p>
                </div>
            </div>
        </div>
    </div>
<?php include '../template/footer_servizi.php'; 