        <!-- Left Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark fixed-top accordion side_bar_scroll" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!-- Logo -->
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-2">CYBER RISK MANAGER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de Bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Mode -->
            <li class="nav-item">
                <a class="nav-link" href="mode_expert&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Mode expert</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Projet</div>

            <li class="nav-item">
                <a class="nav-link projet_link" style="margin-top:10px" href="planification&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Planification</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link projet_link" href="index_documentaire&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Index documentaire</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link projet_link" href="index_documentaire&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                    <i class="fas fa-fw fa-code-branch"></i>
                    <span>Version du produit</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link projet_link" href="index_documentaire&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                    <i class="fas fa-fw fas fa-sitemap"></i>
                    <span>Architecture</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" style="margin-top:15px">

            <!-- Heading -->
            <div class="sidebar-heading">Ateliers</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item py-1">
                <a class="nav-link collapsed py-1" href="#" data-toggle="collapse" data-target="#Atelier1"
                    aria-expanded="true" aria-controls="Atelier1">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity"
                                    d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">1</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span class="nom_atelier">Cadrage et socle de sécurité</span>
                </a>
                <div id="Atelier1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-1a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_1" title="Cadrer l’étude">Cadrer l’étude</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-1b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_2" title="Biens primordiaux/support">Biens primordiaux/support</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-1c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.c"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.c</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_3" title="Événements redoutés">Événements redoutés</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-1d&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.d"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.d</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_4" title="Le socle de sécurité">Le socle de sécurité</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link collapsed py-1" href="#" data-toggle="collapse" data-target="#Atelier2"
                    aria-expanded="true" aria-controls="Atelier2">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="2" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">2</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Source de risque</span>
                </a>
                <div id="Atelier2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-2a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="2.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">2.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_5"
                                title="Identifier les sources de risques et les objectifs">Identifier les sources de risques et les objectifs</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-2b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="2.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">2.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_6"
                                title="Évaluer les couples sources de risque/objectifs visés">Évaluer les couples sources de risque/objectifs visés</span>
                        </a>
                        <a class="collapse-item" href="atelier-2c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                        <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                            <g transform="translate(-124 -292)">
                            <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                            <text class="number_sub_activity_text" data-name="2.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">2.c</tspan></text>
                            </g>
                        </svg>
                        </i>
                        <span id="nom_sous_atelier_15" title="Sélectionner les couples SR/OV retenus pour la suite de l'analyse">Sélectionner les couples SR/OV retenus pour la suite de l'analyse</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link collapsed py-1" href="#" data-toggle="collapse" data-target="#Atelier3"
                    aria-expanded="true" aria-controls="Atelier3">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="3" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">3</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Scénarios stratégiques</span>
                </a>
                <div id="Atelier3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-3a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="3.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">3.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_7"
                                title="Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques">Construire
                                la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-3b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="3.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">3.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_8" title="Élaborer des scénarios stratégiques">Élaborer des scénarios stratégiques</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-3c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="3.c"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">3.c</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_9"
                                title="Définir des mesures de sécurité sur l’écosystème">Définir des mesures de sécurité sur l’écosystème</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link collapsed py-1" href="#" data-toggle="collapse" data-target="#Atelier4"
                    aria-expanded="true" aria-controls="Atelier4">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="4" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">4</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Scénarios opérationnels</span>
                </a>
                <div id="Atelier4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-4a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="4.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">4.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_10" title="Élaborer les scénarios opérationnels">Élaborer les scénarios opérationnels</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-4b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="4.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">4.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_11"
                                title="Évaluer la vraisemblance des scénarios opérationnels">Évaluer la vraisemblance des scénarios opérationnels</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item py-1">
                <a class="nav-link collapsed py-1" href="#" data-toggle="collapse" data-target="#Atelier5"
                    aria-expanded="true" aria-controls="Atelier5">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="5" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">5</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Traitement du risque</span>
                </a>
                <div id="Atelier5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-5a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_12"
                                title="Réaliser une synthèse des scénarios de risque">Réaliser une synthèse des scénarios de risque</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-5b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_13"
                                title="Décider de la stratégie de traitement du risque et définir les mesures de sécurité">Décider de la stratégie de traitement du risque et définir les mesures de sécurité</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-5c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.c"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.c</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_14" title="Évaluer et documenter les risques résiduels">Évaluer et documenter les risques résiduels</span>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div id="rounded_button" class="text-center">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Left Sidebar -->