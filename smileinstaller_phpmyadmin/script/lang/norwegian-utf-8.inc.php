<?php
/* $Id: norwegian-utf-8.inc.php,v 1.1 2005/02/03 06:03:49 nuhpardon Exp $ */

/**
 * Translated by Sven-Erik Andersen <sven-erik.andersen at pkf107.no>
 */

$charset = 'utf-8';
$allow_recoding = TRUE;
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Søn', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'Lør');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d. %B, %Y klokka %H:%M %p';
$timespanfmt = '%s dager, %s timer, %s minutter og %s sekunder';

$strAPrimaryKey = 'En primærnøkkel har blitt lagt til %s';
$strAbortedClients = 'Avbrutt';
$strAbsolutePathToDocSqlDir = 'Vennligst skriv inn den absolutte stien på webtjeneren til docSQL katalogen';
$strAccessDenied = 'Ingen tilgang';
$strAccessDeniedExplanation = 'phpMyAdmin forsøkte å koble til MySQL-serveren, og serveren avviste tilkoblingen. Du må kontrollere vert (host), brukernavn (username) og passord (password) i config.inc.php og sjekke at de tilsvarer den informasjonen du fikk fra MySQL-server administratoren.';
$strAction = 'Handling';
$strAddAutoIncrement = 'Legg til AUTO_INCREMENT verdi';
$strAddConstraints = 'Legg til begrensninger';
$strAddDeleteColumn = 'Legg til/Slett kolonne';
$strAddDeleteRow = 'Legg til/Slett kriterierad';
$strAddDropDatabase = 'Legg til DROP DATABASE';
$strAddFields = 'Legg til %s felt(er)';
$strAddHeaderComment = 'Legg til egen kommentar i hodet (\\n lager linjeskift)';
$strAddIfNotExists = 'Legg til IF NOT EXISTS';
$strAddIntoComments = 'Legg til i kommentarer';
$strAddNewField = 'Legg til felt';
$strAddPrivilegesOnDb = 'Legg til privilegier til følgende database';
$strAddPrivilegesOnTbl = 'Legg til privilegier til følgende tabell';
$strAddSearchConditions = 'Legg til søkekriterier (innhold i "where"-setningen):';
$strAddToIndex = 'Legg til indeks&nbsp;%s&nbsp;kolonne(r)';
$strAddUser = 'Legg til en ny bruker';
$strAddUserMessage = 'Du har lagt til en ny bruker.';
$strAddedColumnComment = 'Lagt til kolonnekommentar';
$strAddedColumnRelation = 'Lagt til relasjon for kolonne';
$strAdministration = 'Administrasjon';
$strAffectedRows = 'Berørte rader:';
$strAfter = 'Etter %s';
$strAfterInsertBack = 'Returner';
$strAfterInsertNewInsert = 'Sett inn en ny post';
$strAfterInsertSame = 'Tilbake til denne siden';
$strAll = 'Alle';
$strAllTableSameWidth = 'vis alle tabeller med samme bredde?';
$strAlterOrderBy = 'Endre tabellrekkefølge ved';
$strAnIndex = 'En indeks har blitt lagt til %s';
$strAnalyzeTable = 'Analyser tabell';
$strAnd = 'og';
$strAny = 'Alle';
$strAnyHost = 'Alle verter';
$strAnyUser = 'Alle brukere';
$strApproximateCount = 'Kan være unøyaktig. Se FAQ 3.11';
$strArabic = 'arabisk';
$strArmenian = 'armensk';
$strAscending = 'Stigende';
$strAtBeginningOfTable = 'Ved begynnelsen av tabellen';
$strAtEndOfTable = 'Ved slutten av tabellen';
$strAttr = 'Attributter';
$strAutodetect = 'Automatisk oppdaging';
$strAutomaticLayout = 'Automatisk disposisjon';

$strBack = 'Tilbake';
$strBaltic = 'baltisk';
$strBeginCut = 'START KUTT';
$strBeginRaw = 'START UFORMATERT';
$strBinLogEventType = 'Hendelsestype';
$strBinLogInfo = 'Informasjon';
$strBinLogName = 'Loggnavn';
$strBinLogOriginalPosition = 'Original posisjon';
$strBinLogPosition = 'Posisjon';
$strBinLogServerId = 'Tjener ID';
$strBinary = ' Binær ';
$strBinaryDoNotEdit = ' Binær - må ikke redigeres ';
$strBinaryLog = 'Binærlogg';
$strBookmarkAllUsers = 'La alle brukere ha adgang til dette bokmerket';
$strBookmarkDeleted = 'Bokmerket har blitt slettet.';
$strBookmarkLabel = 'Navn';
$strBookmarkOptions = 'Bokmerkeinnstillinger';
$strBookmarkQuery = 'Lagret SQL-spørring';
$strBookmarkThis = 'Lagre denne SQL-spørringen';
$strBookmarkView = 'Bare se';
$strBrowse = 'Se på';
$strBrowseForeignValues = 'Se de eksterne verdiene';
$strBulgarian = 'bulgarsk';
$strBzError = 'phpMyAdmin kunne ikke komprimere dumpede data fordi Bz2 tillegget til denne php versjonen er ødelagt. Vi anbefaler på det sterkeste at du setter <code>$cfg[\'BZipDump\']</code> direktivet i din phpMyAdmin konfigurasjonsfil til <code>FALSE</code>. Hvis du ønsker å bruke Bz2 komprimerings funksjonene, så bør du oppgradere til en nyere php versjon. Se php bug rapport %s for detaljer.';
$strBzip = 'Komprimert (bz2)';

$strCSVOptions = 'CSV valg';
$strCalendar = 'Kalender';
$strCannotLogin = 'Kan ikke logge inn til MySQL tjeneren';
$strCantLoad = 'kan ikke starte %s tillegget,<br />vennligst kontroller PHP-konfigurasjonen';
$strCantLoadRecodeIconv = 'Kan ikke laste iconv- eller recode-modulen som trengs for tegnsett konvertering, konfigurer php slik at disse kan lastes eller slå av tegnsettkonvertering i phpMyAdmin.';
$strCantRenameIdxToPrimary = 'Kan ikke endre indeks til PRIMARY!';
$strCantUseRecodeIconv = 'Kan ikke bruke hverken iconv, libiconv eller recode_string funksjonene selv om modulene sier de er lastet. Sjekk din php-konfigurasjon.';
$strCardinality = 'Kardinalitet';
$strCarriage = 'Linjeskift (Mac): \\r';
$strCaseInsensitive = 'uavhengig av bokstavstørelse';
$strCaseSensitive = 'avhengig av bokstavstørelse';
$strCentralEuropean = 'sentraleuropeisk';
$strChange = 'Endre';
$strChangeCopyMode = 'Opprett ny bruker med de samme privilegier og ...';
$strChangeCopyModeCopy = '... behold den gamle.';
$strChangeCopyModeDeleteAndReload = ' ... slett den gamle fra brukertabellene og deretter oppfrisk privilegiene.';
$strChangeCopyModeJustDelete = ' ... slett den gamle fra brukertabellene.';
$strChangeCopyModeRevoke = ' ... tilbakekall alle aktive privilegier fra den gamle og slett den etterpå.';
$strChangeCopyUser = 'Endre innloggingsinformasjon / kopiere bruker';
$strChangeDisplay = 'Velg felt for visning';
$strChangePassword = 'Endre passord';
$strCharset = 'Tegnsett';
$strCharsetOfFile = 'Filens tegnsett:';
$strCharsets = 'Tegnsett';
$strCharsetsAndCollations = 'Tegnsett og kollasjoneringer';
$strCheckAll = 'Merk alle';
$strCheckOverhead = 'Kontroller overheng';
$strCheckPrivs = 'Kontroller privilegier';
$strCheckPrivsLong = 'Kontroller privilegier for databasen &quot;%s&quot;.';
$strCheckTable = 'Kontroller tabell';
$strChoosePage = 'Vennligst velg en side for redigering';
$strColComFeat = 'Vis kolonnekommentarer';
$strCollation = 'Kollasjonering';
$strColumnNames = 'Kolonnenavn';
$strColumnPrivileges = 'Kolonne-spesifikke privilegier';
$strCommand = 'Kommando';
$strComments = 'Kommentarer';
$strCommentsForTable = 'TABELLKOMMENTARER';
$strCompatibleHashing = 'MySQL&nbsp;4.0 kompatibel';
$strCompleteInserts = 'Komplette innlegg';
$strCompression = 'Kompresjon';
$strConfigFileError = 'phpMyAdmin kunne ikke lese din konfigurasjonsfil!<br />Dette kan skje hvis PHP finner en syntaksfeil eller ikke kan finne filen.<br />Vennligst kall opp konfigurasjonsfilen direkte via linken under og les PHP feilmeldingen(e) som du vil få. I de fleste tilfeller så mangler det et anførselstegn eller et semikolon et sted.<br />Hvis du får en blank side så er alt ok.';
$strConfigureTableCoord = 'Vennligst konfigurer koordinatene for tabell %s';
$strConnectionError = 'Kan ikke koble til: ugyldige innstillinger.';
$strConnections = 'tilkoblinger';
$strConstraintsForDumped = 'Begrensninger for dumpede tabeller';
$strConstraintsForTable = 'Begrensninger for tabell';
$strCookiesRequired = 'Cookies må være slått på forbi dette punkt.';
$strCopyDatabaseOK = 'Databasen %s har blitt kopiert til %s';
$strCopyTable = 'Kopier tabell til (database<b>.</b>tabell):';
$strCopyTableOK = 'Tabellen %s er kopiert til %s.';
$strCopyTableSameNames = 'Kan ikke kopiere tabellen til samme navn!';
$strCouldNotKill = 'phpMyAdmin kunne ikke avslutte tråd %s. Den er sansynligvis alt avsluttet.';
$strCreate = 'Opprett';
$strCreateIndex = 'Lag en indeks på&nbsp;%s&nbsp;kolonner';
$strCreateIndexTopic = 'Lag en ny indeks';
$strCreateNewDatabase = 'Opprett ny database';
$strCreateNewTable = 'Opprett ny tabell i database %s';
$strCreatePage = 'Lag en ny side';
$strCreatePdfFeat = 'Lag PDF-dokumenter';
$strCreationDates = 'Opprettelse/Oppdaterings/Kontrolldateo';
$strCriteria = 'Kriterier';
$strCroatian = 'kroatisk';
$strCyrillic = 'kyrillisk';
$strCzech = 'tjekkisk';
$strCzechSlovak = 'Tjekkoslovakisk';

$strDBComment = 'Database kommentar: ';
$strDBCopy = 'Kopier databasen til';
$strDBGContext = 'Sammenheng';
$strDBGContextID = 'Sammenhengs-ID';
$strDBGHits = 'Treff';
$strDBGLine = 'Linje';
$strDBGMaxTimeMs = 'Max tid, ms';
$strDBGMinTimeMs = 'Min tid, ms';
$strDBGModule = 'Modul';
$strDBGTimePerHitMs = 'Tid/Treff, ms';
$strDBGTotalTimeMs = 'Total tid, ms';
$strDBRename = 'Endre databasens navn til';
$strDanish = 'dansk';
$strData = 'Data';
$strDataDict = 'Dataordbok';
$strDataOnly = 'Bare data';
$strDatabase = 'Database';
$strDatabaseEmpty = 'Databasens navn er tomt!';
$strDatabaseExportOptions = 'Databaseeksportinnstillinger';
$strDatabaseHasBeenDropped = 'Databasen %s har blitt slettet';
$strDatabaseNoTable = 'Denne databasen har ingen tabeller!';
$strDatabases = 'databaser';
$strDatabasesDropped = '%s databasene har blitt slettet.';
$strDatabasesStats = 'Statistikk for databaser';
$strDatabasesStatsDisable = 'Slå av statistikk';
$strDatabasesStatsEnable = 'Slå på statistikk';
$strDatabasesStatsHeavyTraffic = 'OBS: Når du slår på Databasestatistikk så kan det medføre stor traffik mellom webtjeneren og MySQL-tjeneren.';
$strDbPrivileges = 'Database-spesifikke privilegier';
$strDbSpecific = 'databasespesifikk';
$strDefault = 'Standard';
$strDefaultValueHelp = 'Sett inn en enkelt verdi for standard verdier uten skråstrek, anførselstegn eller annen &quot;escaping&quot; med dette formatet: a';
$strDefragment = 'Defragmenter tabell';
$strDelOld = 'Den nåværende siden har referanser til tabeller som ikke lenger eksisterer. Vil du slette disse referansene?';
$strDelayedInserts = 'Bruk forsinkede innsettinger';
$strDelete = 'Slett';
$strDeleteAndFlush = 'Slett brukeren og oppfrisk privilegiene etterpå.';
$strDeleteAndFlushDescr = 'Dette er den beste måten, men oppfrisking av privilegiene kan ta litt tid.';
$strDeleted = 'Raden er slettet';
$strDeletedRows = 'Slettede rader:';
$strDeleting = 'Sletter %s';
$strDescending = 'Synkende';
$strDescription = 'Beskrivelse';
$strDictionary = 'ordbok';
$strDisableForeignChecks = 'Slå av kontroll av fremmednøkler';
$strDisabled = 'Avslått';
$strDisplayFeat = 'Vis egenskaper';
$strDisplayOrder = 'Visningsrekkefølge:';
$strDisplayPDF = 'Vis PDF-skjema';
$strDoAQuery = 'Utfør en "spørring ved eksempel" (jokertegn: "%")';
$strDoYouReally = 'Vil du virkelig ';
$strDocu = 'Dokumentasjon';
$strDrop = 'Slett';
$strDropDatabaseStrongWarning = 'Du er i ferd med å SLETTE en komplett database!';
$strDropSelectedDatabases = 'Slett valgte databaser';
$strDropUsersDb = 'Slett databasene som har det samme navnet som brukerne.';
$strDumpSaved = 'Dump har blitt lagret til fila %s.';
$strDumpXRows = 'Dumpe %s rader fra rad %s.';
$strDumpingData = 'Dataark for tabell';
$strDynamic = 'dynamisk';

$strEdit = 'Endre';
$strEditPDFPages = 'Rediger PDF-sider';
$strEditPrivileges = 'Rediger privilegier';
$strEffective = 'Effektiv';
$strEmpty = 'Tøm';
$strEmptyResultSet = 'MySQL returnerte ett tomt resultat (m.a.o. ingen rader).';
$strEnabled = 'Påslått';
$strEncloseInTransaction = 'Inneslutt eksport i en transaksjon';
$strEnd = 'Slutt';
$strEndCut = 'STOPP KUTT';
$strEndRaw = 'STOPP UFORMATERT';
$strEnglish = 'engelsk';
$strEnglishPrivileges = 'OBS: MySQL privilegiumnavn er på engelsk';
$strError = 'Feil';
$strEstonian = 'estisk';
$strExcelEdition = 'Excel-versjon';
$strExcelOptions = 'Excel-innstillinger';
$strExecuteBookmarked = 'Utfør lagret spørring';
$strExplain = 'Forklar SQL';
$strExport = 'Eksporter';
$strExtendedInserts = 'Utvidete innlegg';
$strExtra = 'Ekstra';

$strFailedAttempts = 'Feilede forsøk';
$strField = 'Felt';
$strFieldHasBeenDropped = 'Feltet %s har blitt slettet';
$strFields = 'Felter';
$strFieldsEmpty = ' Antall felter er tommt! ';
$strFieldsEnclosedBy = 'Felter omsluttet av';
$strFieldsEscapedBy = 'Felter beskyttet med';
$strFieldsTerminatedBy = 'Felter avsluttet med';
$strFileAlreadyExists = 'Fila %s eksisterer alt på serveren, endre navnet eller merk av for overskriving av fil.';
$strFileCouldNotBeRead = 'Fila kunne ikke leses';
$strFileNameTemplate = 'Filnavnsmal';
$strFileNameTemplateHelp = 'Bruk __DB__ for databasenavn, __TABLE__ for tabellnavn og %svalgfrie strftime%s valg for tidsspesifikasjon, tilleggene vil bli \'automagisk\' lagt til.. All annen tekst vil bli bevart.';
$strFileNameTemplateRemember = 'husk malen';
$strFixed = 'statisk';
$strFlushPrivilegesNote = 'Merk: phpMyAdmin får brukerprivilegiene direkte fra MySQL privilegietabeller. Innholdet i disse tabellene kan være forskjellig fra de privilegiene tjeneren bruker hvis det er utført manuelle endringer på den. I så fall bør du %soppfriske privilegiene%s før du fortsetter.';
$strFlushTable = 'Oppfrisk tabellen ("FLUSH")';
$strFormEmpty = 'Manglende verdi i skjemaet!';
$strFormat = 'Format';
$strFullText = 'Hele strenger';
$strFunction = 'Funksjon';

$strGenBy = 'Generert av';
$strGenTime = 'Generert den';
$strGeneralRelationFeat = 'Generelle relasjonsegenskaper';
$strGeorgian = 'Georgisk';
$strGerman = 'tysk';
$strGlobal = 'global';
$strGlobalPrivileges = 'Globale privilegier';
$strGlobalValue = 'Global verdi';
$strGo = 'Utfør';
$strGrantOption = 'Rettighet';
$strGreek = 'gresk';
$strGzip = 'Komprimert (gz)';

$strHasBeenAltered = 'er endret.';
$strHasBeenCreated = 'er opprettet.';
$strHaveToShow = 'Du må velge minst en kolonne for visning';
$strHebrew = 'hebraisk';
$strHexForBinary = 'Bruk heksadesimal for binære felter';
$strHome = 'Hjem';
$strHomepageOfficial = 'Offisiell phpMyAdmin-hjemmeside';
$strHost = 'Vert';
$strHostEmpty = 'Vertsnavnet er tomt!';
$strHungarian = 'ungarsk';

$strIcelandic = 'Islandsk';
$strId = 'ID';
$strIdxFulltext = 'Fulltekst';
$strIfYouWish = 'Hvis du kun ønsker å lese inn enkelte av tabellens kolonner, angi en kommaseparert feltliste.';
$strIgnore = 'Ignorer';
$strIgnoreInserts = 'Bruk ignore inserts';
$strIgnoringFile = 'Ignorerer fil %s';
$strImportDocSQL = 'Importer docSQL-filer';
$strImportFiles = 'Importer filer';
$strImportFinished = 'Importen er ferdig';
$strInUse = 'i bruk';
$strIndex = 'Indeks';
$strIndexHasBeenDropped = 'Indeksen %s har blitt slettet';
$strIndexName = 'Indeksnavn&nbsp;:';
$strIndexType = 'Indekstype&nbsp;:';
$strIndexWarningMultiple = 'Mer enn en %s nøkkel ble opprettet for kolonne `%s`';
$strIndexWarningPrimary = 'Både PRIMARY og INDEX nøkler bør ikke settes for kolonne `%s`';
$strIndexWarningTable = 'Problemer med indeksene i tabellen `%s`';
$strIndexWarningUnique = 'Både UNIQUE og INDEX nøkler bør ikke settes for kolonne `%s`';
$strIndexes = 'Indekser';
$strInnodbStat = 'InnoDB status';
$strInsecureMySQL = 'Din konfigurasjonsfil inneholder innstillinger (root uten passord) som korrensponderer med MySQLs standard priviligerte brukerkonto. Din MySQL-tjener kjører med denne standardinnstillingen, er åpen for misbruk, og du burde fikse dette sikkerhetshullet snarest.';
$strInsert = 'Sett inn';
$strInsertAsNewRow = 'Sett inn som ny rad';
$strInsertBookmarkTitle = 'Skriv inn bokmerketittel';
$strInsertNewRow = 'Sett inn ny rad';
$strInsertTextfiles = 'Les tekstfil inn i tabell';
$strInsertedRowId = 'Satt inn rad id:';
$strInsertedRows = 'Innsatte rader:';
$strInstructions = 'Instruksjoner';
$strInternalNotNecessary = '* En intern relasjon er ikke nødvendig når den også eksisterer i InnoDB.';
$strInternalRelations = 'Interne relasjoner';

$strJapanese = 'japansk';
$strJumpToDB = 'Hopp til databasen &quot;%s&quot;.';
$strJustDelete = 'Bare slett brukerne fra privilegium tabellene.';
$strJustDeleteDescr = 'Den &quot;slettede&quot; brukeren vil fortsatt kunne bruke tjeneren som normalt inntill privilegiene er oppfrisket.';

$strKeepPass = 'Ikke endre passordet';
$strKeyname = 'Nøkkel';
$strKill = 'Avslutt';
$strKorean = 'koreansk';

$strLaTeX = 'LaTeX';
$strLaTeXOptions = 'LaTeX innstillinger';
$strLandscape = 'Landskapsformat';
$strLatexCaption = 'Tabelloverskrift';
$strLatexContent = 'Innhold i tabell __TABLE__';
$strLatexContinued = '(fortsettet)';
$strLatexContinuedCaption = 'Fortsettet tabelloverskrift';
$strLatexIncludeCaption = 'Inkluder tabelloverskrift';
$strLatexLabel = 'Merkelappnøkkel';
$strLatexStructure = 'Struktur i tabell __TABLE__';
$strLatvian = 'Latvisk';
$strLengthSet = 'Lengde/Sett*';
$strLimitNumRows = 'Antall poster per side';
$strLineFeed = 'Linjeskift: \\n';
$strLinesTerminatedBy = 'Linker avsluttet med';
$strLinkNotFound = 'Link ikke funnet';
$strLinksTo = 'Linker til';
$strLithuanian = 'lithauisk';
$strLoadExplanation = 'Den beste måten er automatiskt valgt, men du kan endre hvis det ikke fungerer.';
$strLoadMethod = 'LOAD metode';
$strLocalhost = 'Lokal';
$strLocationTextfile = 'Plassering av filen';
$strLogPassword = 'Passord:';
$strLogServer = 'Tjener';
$strLogUsername = 'Brukernavn:';
$strLogin = 'Logg inn';
$strLoginInformation = 'Innlogingsinformasjon';
$strLogout = 'Logg ut';

$strMIMETypesForTable = 'MIME TYPER FOR TABELLEN';
$strMIME_MIMEtype = 'MIME-type';
$strMIME_available_mime = 'Tilgjengelige MIME-typer';
$strMIME_available_transform = 'Tilgjengelige transformationer';
$strMIME_description = 'Beskrivelse';
$strMIME_nodescription = 'Ingen beskrivelse er tilgjengelig for denne transformasjonen.<br />Spør forfatteren hva %s gjør.';
$strMIME_transformation = 'Nettvisertransformasjon';
$strMIME_transformation_note = 'For en liste over tilgjengelige transformasjonsvalg, klikk på %stransformasjonsbeskrivelser%s';
$strMIME_transformation_options = 'Transformasjonsvalg';
$strMIME_transformation_options_note = 'Skriv inn verdiene for transformasjon med dette formatet: \'a\',\'b\',\'c\'...<br />Hvis du trenger å bruke en skråstrek ("\") eller en enkel apostrof ("\'") blant disse verdiene så sett en skråstrek foran (eks. \'\\\\xyz\' eller \'a\\\'b\').';
$strMIME_without = 'MIME-typer skrevet i kursiv har ikke en separat transformasjonsfunksjon';
$strMaximumSize = 'Maksimum størelse: %s%s';
$strModifications = 'Endringene er lagret';
$strModify = 'Endre';
$strModifyIndexTopic = 'Endre en indeks';
$strMoreStatusVars = 'Flere status variabler';
$strMoveTable = 'Flytt tabell til (database<b>.</b>tabell):';
$strMoveTableOK = 'Tabellen %s har blitt flyttet til %s.';
$strMoveTableSameNames = 'Kan ikke flytte tabellen til samme navn!';
$strMultilingual = 'flerspråkelig';
$strMustSelectFile = 'Du må velge fila du ønsker å sette inn.';
$strMySQLCharset = 'MySQL-tegnsett';
$strMySQLConnectionCollation = 'Kollasjon av MySQL-oppkobling';
$strMySQLReloaded = 'MySQL omstartet.';
$strMySQLSaid = 'MySQL sa: ';
$strMySQLServerProcess = 'MySQL %pma_s1% som kjører på %pma_s2% som %pma_s3%';
$strMySQLShowProcess = 'Vis prosesser';
$strMySQLShowStatus = 'Vis MySQL driftsstatus';
$strMySQLShowVars = 'Vis MySQL systemvariabler';

$strName = 'Navn';
$strNeedPrimaryKey = 'Du burde definere en primærnøkkel for denne tabellen.';
$strNext = 'Neste';
$strNo = 'Nei';
$strNoActivity = 'Ingen aktivitet på %s sekunder eller mer, du må logge inn på nytt';
$strNoDatabases = 'Ingen databaser';
$strNoDatabasesSelected = 'Ingen databaser er valgt.';
$strNoDescription = 'ingen beskrivelse';
$strNoDropDatabases = '"DROP DATABASE"-uttrykk er avslått.';
$strNoExplain = 'Ikke forklar SQL';
$strNoFrames = 'phpMyAdmin er mer brukervennlig med en <b>rammekapabel</b> nettleser.';
$strNoIndex = 'Ingen indeks definert!';
$strNoIndexPartsDefined = 'Ingen indeksdeler definert!';
$strNoModification = 'Ingen endring';
$strNoOptions = 'Dette formatet har ingen valg';
$strNoPassword = 'Intet passord';
$strNoPermission = 'Webserveren har ikke tillatelse til å lagre fila %s.';
$strNoPhp = 'uten PHP kode';
$strNoPrivileges = 'Ingen privilegier';
$strNoQuery = 'Ingen SQL spørring!';
$strNoRights = 'Du har ikke nok rettigheter til å være her nå!';
$strNoRowsSelected = 'Ingen rader valgt';
$strNoSpace = 'Ikke nok plass til å lagre fila %s.';
$strNoTablesFound = 'Ingen tabeller i databasen.';
$strNoThemeSupport = 'Ikke støtte for maler, kontroller konfigureringen og/eller dine maler i katalogen %s.';
$strNoUsersFound = 'Ingen bruker(e) funnet.';
$strNoValidateSQL = 'Ikke teste SQL';
$strNone = 'Ingen';
$strNotNumber = 'Dette er ikke ett tall!';
$strNotOK = 'ikke OK';
$strNotSet = '<b>%s</b> tabellen ble ikke funnet eller ikke konfigurert i %s';
$strNotValidNumber = ' er ikke et gyldig radnummer!';
$strNull = 'Null';
$strNumSearchResultsInTable = '%s treff i tabell <i>%s</i>';
$strNumSearchResultsTotal = '<b>Totalt:</b> <i>%s</i> treff';
$strNumTables = 'Tabeller';

$strOK = 'OK';
$strOftenQuotation = 'Ofte anførselstegn. Valgfritt innebærer at kun tekstfelter ("char" og "varchar"-felter) er omfattet av tegnet.';
$strOperations = 'Operasjoner';
$strOperator = 'Operator';
$strOptimizeTable = 'Optimiser tabell';
$strOptionalControls = 'Valgfritt. Angir hvordan spesialtegn skrives eller leses.';
$strOptionally = 'Valgfritt';
$strOr = 'Eller';
$strOverhead = 'Overheng';
$strOverwriteExisting = 'Overskriv eksisterende fil(-er)';

$strPHP40203 = 'Du bruker PHP 4.2.3, som har en alvorlig feil med flerbyte-strenger (mbstring). Se PHP-feilrapport 19404. Denne versjonen av PHP er ikke anbefalt for bruk med phpMyAdmin.';
$strPHPVersion = 'PHP-Versjon';
$strPageNumber = 'Sidenummer:';
$strPaperSize = 'Papirstørelse';
$strPartialText = 'Delvis tekst';
$strPassword = 'Passord';
$strPasswordChanged = 'Passordet til %s er endret.';
$strPasswordEmpty = 'Passordet er blankt!';
$strPasswordHashing = 'Passordnøkling';
$strPasswordNotSame = 'Passordene er ikke like!';
$strPdfDbSchema = 'Skjema for "%s"-databasen - Side %s';
$strPdfInvalidTblName = 'Tabellen "%s" eksisterer ikke!';
$strPdfNoTables = 'Ingen tabeller';
$strPerHour = 'per time';
$strPerMinute = 'per minutt';
$strPerSecond = 'per sekund';
$strPersian = 'Persisk';
$strPhoneBook = 'telefonkatalog';
$strPhp = 'Lag PHP kode';
$strPmaDocumentation = 'phpMyAdmin-Dokumentasjon';
$strPmaUriError = '<tt>$cfg[\'PmaAbsoluteUri\']</tt> variabelen MÅ være innstilt i din konfigurasjonsfil!';
$strPolish = 'Polsk';
$strPortrait = 'Portrettformat';
$strPos1 = 'Start';
$strPrevious = 'Forrige';
$strPrimary = 'Primær';
$strPrimaryKeyHasBeenDropped = 'Primærnøkkelen har blitt slettet';
$strPrimaryKeyName = 'Navnet til  primærnøkkelen må være... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>må</b> være navnet til og <b>bare til</b> en primærnøkkel!)';
$strPrint = 'Skriv ut';
$strPrintView = 'Utskriftsvennlig forhåndsvisning';
$strPrintViewFull = 'Forhåndsvisning (med all tekst)';
$strPrivDescAllPrivileges = 'Inkluder alle privilegier unntatt GRANT.';
$strPrivDescAlter = 'Tillater endring av struktur på eksisterende tabeller.';
$strPrivDescCreateDb = 'Tillater oppretting av nye databaser og tabeller.';
$strPrivDescCreateTbl = 'Tillater oppretting av nye tabeller.';
$strPrivDescCreateTmpTable = 'Tillater oppretting av midlertidige tabeller.';
$strPrivDescDelete = 'Tillater sletting av data.';
$strPrivDescDropDb = 'Tillater sletting av databaser og tabeller.';
$strPrivDescDropTbl = 'Tillater sletting av tabeller.';
$strPrivDescExecute = 'Tillater kjøring av lagrede prosedyrer; har ingen effekt på denne versjonen av MySQL.';
$strPrivDescFile = 'Tillater import og eksport av data til og fra filer.';
$strPrivDescGrant = 'Tillater å legge til brukere og privilegier uten å oppfriske privilegietabellene.';
$strPrivDescIndex = 'Tillater oppretting og sletting av indekser.';
$strPrivDescInsert = 'Tillater å legge til og erstatte data.';
$strPrivDescLockTables = 'Tillater låsing av tabeller for den kjørende tråden.';
$strPrivDescMaxConnections = 'Begrenser antall nye tilkoblinger brukeren kan åpne per time.';
$strPrivDescMaxQuestions = 'Begrenser antall spørringer brukeren kan sende til tjeneren per time.';
$strPrivDescMaxUpdates = 'Begrenser antall kommandoer som kan endre tabeller eller databaser brukeren kan utføre per time.';
$strPrivDescProcess3 = 'Tillater avslutting av prosesser som tilhører andre brukere.';
$strPrivDescProcess4 = 'Tillater visning av komplette spørringer i prosesslisten.';
$strPrivDescReferences = 'har ingen effekt i denne versjonen av MySQL.';
$strPrivDescReload = 'Tillater oppfrisking av tjenerinnstillinger og oppfrisking av mellomlager.';
$strPrivDescReplClient = 'Gir tillatelse til brukeren til å spørre hvor replikasjonsslaver eller -tjenere er.';
$strPrivDescReplSlave = 'Trenges av replikasjonsslavene.';
$strPrivDescSelect = 'Tillater lesing av data.';
$strPrivDescShowDb = 'Gir adgang til komplett liste over databaser.';
$strPrivDescShutdown = 'Tillater avslutting av tjener.';
$strPrivDescSuper = 'Tillater tilkobling, selv om maksimum tilkoblinger er nådd. Behøves for de fleste administrative operasjoner som å sette globale variabler eller avslutting av andre brukeres tråder.';
$strPrivDescUpdate = 'Tillater endring av data.';
$strPrivDescUsage = 'Ingen privilegier.';
$strPrivileges = 'Privilegier';
$strPrivilegesReloaded = 'Oppfriskingen av privilegiene lyktes.';
$strProcesslist = 'Prosess liste';
$strPutColNames = 'Sett inn feltnavn i første rad';

$strQBE = 'Spørring ved eksempel (Query by Example)';
$strQBEDel = 'Slett';
$strQBEIns = 'Sett inn';
$strQueryFrame = 'Spørringsvindu';
$strQueryOnDb = 'SQL-spørring i database <b>%s</b>:';
$strQuerySQLHistory = 'SQL-historie';
$strQueryStatistics = '<b>Spørrings statistikk</b>: Siden oppstart, har %s spørringer blitt sendt til tjeneren.';
$strQueryTime = 'Spørring tok %01.4f sek';
$strQueryType = 'Spørringstype';
$strQueryWindowLock = 'Ikke overskriv denne spørringen fra andre vinduer';

$strReType = 'Gjenta';
$strReceived = 'Mottatt';
$strRecords = 'Rader';
$strReferentialIntegrity = 'Sjekk referanseintegritet:';
$strRefresh = 'Oppdater';
$strRelationNotWorking = 'Tilleggsfunksjonene for å kunne jobbe med koblede tabeller er deaktivert. For å finne ut hvorfor, klikk %sher%s.';
$strRelationView = 'Relasjonsvisning';
$strRelationalSchema = 'Relasjonsskjema';
$strRelations = 'Relasjoner';
$strRelationsForTable = 'RELASJONER FOR TABELLEN';
$strReloadFailed = 'Omstart av MySQL feilet.';
$strReloadMySQL = 'Omstart av MySQL';
$strReloadingThePrivileges = 'Oppfrisker privilegiene';
$strRemoveSelectedUsers = 'Fjern valgte brukere';
$strRenameDatabaseOK = 'Databasen %s har endret navn til %s';
$strRenameTable = 'Endre tabellens navn';
$strRenameTableOK = 'Tabellen %s har fått nytt navn %s';
$strRepairTable = 'Reparer tabell';
$strReplace = 'Erstatt';
$strReplaceNULLBy = 'Erstatt NULL med';
$strReplaceTable = 'Erstatt tabell med filen';
$strReset = 'Tøm skjema';
$strResourceLimits = 'Ressursbegrensninger';
$strRevoke = 'Tilbakekall';
$strRevokeAndDelete = 'Tilbakekall alle aktive privilegier fra brukerne og slett dem etterpå.';
$strRevokeAndDeleteDescr = 'Inntill privilegiene er oppfrisket vil brukerne fortsatt ha USAGE privilegiet.';
$strRevokeMessage = 'Du har fjernet privilegiene til %s';
$strRomanian = 'Rumensk';
$strRowLength = 'Radlengde';
$strRowSize = ' Radstørelse ';
$strRows = 'Rader';
$strRowsFrom = 'rader fra';
$strRowsModeFlippedHorizontal = 'horisontal (roterte overskrifter)';
$strRowsModeHorizontal = 'vannrett';
$strRowsModeOptions = 'i %s modus og gjenta headers etter %s celler';
$strRowsModeVertical = 'loddrett';
$strRowsStatistic = 'Radstatistikk';
$strRunQuery = 'Kjør spørring';
$strRunSQLQuery = 'Kjør SQL spørring/spørringer mot databasen %s';
$strRunning = 'som kjører på %s';
$strRussian = 'russisk';

$strSQL = 'SQL';
$strSQLExportType = 'Eksporttype';
$strSQLOptions = 'SQL valg';
$strSQLParserBugMessage = 'Det er en mulighet for at du har funnet en feil i SQL-parseren. Vennligst kontroller din spørring nøye og kontroller at anførselstegn er korrekte og matsjer hverandre. En annen mulig feilårsak kan være at du overfører en fil med binærkode som ikke ligger innenfor anførselstegn. Du kan også teste din spørring i MYSQLs kommandolinjegrensesnitt. Feilmeldingen fra MySQL-tjeneren nedenfor, hvis det var en, kan også hjelpe deg med å analysere problemet. Hvis du fortsatt har problemer eller parseren feiler hvor kommandolinjegrensesnittet lyktes, vennligst reduser din SQL-spørring til den spørringen som forårsaker problemet og send en feilrapport med datastykket i CUT-seksjonen nedenfor:';
$strSQLParserUserError = 'Det ser ut til å være en feil i din SQL-spørring. En eventuell feilmelding fra MySQL-tjeneren er skrevet ut nedenfor, kan kanskje hjelpe deg med å finne feilen.';
$strSQLQuery = 'SQL-spørring';
$strSQLResult = 'SQL-resultat';
$strSQPBugInvalidIdentifer = 'Ugyldig identifikator';
$strSQPBugUnclosedQuote = 'Anførselstegnet er ikke lukket';
$strSQPBugUnknownPunctuation = 'Ukjent tegnsettingsstreng';
$strSave = 'Lagre';
$strSaveOnServer = 'Lagre på server i %s katalogen';
$strScaleFactorSmall = 'Skaleringsfaktoren er for liten til å romme alt på en side';
$strSearch = 'Søk';
$strSearchFormTitle = 'Søk i database';
$strSearchInTables = 'I tabell(ene):';
$strSearchNeedle = 'Ord eller verdi(er) å søke etter (jokertegn: "%"):';
$strSearchOption1 = 'minst ett av ordene';
$strSearchOption2 = 'alle ordene';
$strSearchOption3 = 'med den nøyaktige setningen';
$strSearchOption4 = 'som "regular expression"';
$strSearchResultsFor = 'Søkeresultat for "<i>%s</i>" %s:';
$strSearchType = 'Finn:';
$strSecretRequired = 'Konfigurasjonsfila trenger nå et hemmelig passordfrase (blowfish_secret).';
$strSelectADb = 'Vennligst velg en database';
$strSelectAll = 'Velg alle';
$strSelectBinaryLog = 'Velg binærlogg for visning';
$strSelectFields = 'Velg felt (minst ett):';
$strSelectNumRows = 'i spørring';
$strSelectTables = 'Velg tabeller';
$strSend = 'Last ned som fil';
$strSent = 'Sendt';
$strServer = 'Tjener';
$strServerChoice = 'Tjenervalg';
$strServerNotResponding = 'Tjeneren svarer ikke';
$strServerStatus = 'Kjøringsinformasjon';
$strServerStatusUptime = 'Denne MySQL tjeneren har kjørt i %s. Den startet opp den %s.';
$strServerTabProcesslist = 'Prosesser';
$strServerTabVariables = 'Variabler';
$strServerTrafficNotes = '<b>Tjenertraffikk</b>: Disse tabellene viser statistikk over nettverkstrafikken for denne MySQL-tjeneren siden dens oppstart.';
$strServerVars = 'Tjenervariabler og -innstillinger';
$strServerVersion = 'Tjenerversjon';
$strSessionValue = 'Økts verdi';
$strSetEnumVal = 'Hvis felttypen er "enum" eller "set", skriv inn verdien med dette formatet: \'a\',\'b\',\'c\'...<br />Hvis du skulle trenge å ha en skråstrek ("\") eller en enkel apostrof ("\'") blant disse verdiene, skriv en skråstrek foran (eks. \'\\\\xyz\' eller \'a\\\'b\').';
$strShow = 'Vis';
$strShowAll = 'Vis alle';
$strShowColor = 'Vis farger';
$strShowDatadictAs = 'Data Ordbok Format';
$strShowFullQueries = 'Vis hele spørringen';
$strShowGrid = 'Vis rutenett';
$strShowPHPInfo = 'Vis PHP-informasjon';
$strShowTableDimension = 'Vis tabelldimensjoner';
$strShowTables = 'Vis tabeller';
$strShowThisQuery = ' Vis denne spørring her igjen ';
$strShowingRecords = 'Viser rader ';
$strSimplifiedChinese = 'forenklet kinesisk';
$strSingly = '(enkeltvis)';
$strSize = 'Størrelse';
$strSlovak = 'Slovakisk';
$strSlovenian = 'Slovensk';
$strSort = 'Sorter';
$strSortByKey = 'Sorter etter nøkkel';
$strSpaceUsage = 'Plassbruk';
$strSpanish = 'Spansk';
$strSplitWordsWithSpace = 'Ord er separert med et mellomrom (" ").';
$strStatCheckTime = 'Sist kontrollert';
$strStatCreateTime = 'Opprettet';
$strStatUpdateTime = 'Sist oppdatert';
$strStatement = 'Oversikt';
$strStatus = 'Status';
$strStrucCSV = 'CSV-data';
$strStrucData = 'Struktur og data';
$strStrucDrop = 'Legg til DROP TABLE';
$strStrucExcelCSV = 'CSV for MS Excel data';
$strStrucNativeExcel = 'Originale MS Excel data';
$strStrucOnly = 'Kun struktur';
$strStructPropose = 'Foreslå tabellstruktur';
$strStructure = 'Struktur';
$strSubmit = 'Send';
$strSuccess = 'Kommandoen/spørringen er utført';
$strSum = 'Sum';
$strSwedish = 'svensk';
$strSwitchToDatabase = 'Bytt til kopiert database';
$strSwitchToTable = 'Bytt til kopiert tabell';

$strTable = 'Tabell';
$strTableComments = 'Tabellkommentarer';
$strTableEmpty = 'Tabellnavnet er tomt!';
$strTableHasBeenDropped = 'Tabellen %s har blitt slettet';
$strTableHasBeenEmptied = 'Tabellen %s har blitt tømt';
$strTableHasBeenFlushed = 'Tabelen %s har blitt oppfrisket';
$strTableMaintenance = 'Tabellvedlikehold';
$strTableOfContents = 'Innholdsfortegnelse';
$strTableOptions = 'Tabellinnstillinger';
$strTableStructure = 'Tabellstruktur for tabell';
$strTableType = 'Tabelltype';
$strTables = '%s tabell(er)';
$strTakeIt = 'velg';
$strTblPrivileges = 'Tabell-spesifikke privilegier';
$strTextAreaLength = ' På grunn av sin lengde,<br /> så vil muligens dette feltet ikke være redigerbart ';
$strThai = 'thai';
$strTheContent = 'Innholdet av filen er lagt inn.';
$strTheContents = 'Innholdet av filen erstatter valgt tabell for rader med lik identifikator eller unikt felt';
$strTheTerminator = 'Tegn som angir slutt på felt.';
$strTheme = 'Tema / Stil';
$strThisHost = 'Denne vert';
$strThisNotDirectory = 'Dette var ikke en katalog';
$strThreadSuccessfullyKilled = 'Tråd %s ble avsluttet med suksess.';
$strTime = 'Tid';
$strToggleScratchboard = 'slå av/på kladdevindu';
$strTotal = 'totalt';
$strTotalUC = 'Totalt';
$strTraditionalChinese = 'Tradisjonell kinesisk';
$strTraditionalSpanish = 'Tradisjonell spansk';
$strTraffic = 'Trafikk';
$strTransformation_application_octetstream__download = 'Vis en link for å kunne laste ned de binære dataene til et felt. Den første opsjonen er filnavnet til den binære fila. Den andre opsjonen er et potensielt feltnavn i en tabell som inneholder filnavnet. Hvis du velger den andre opsjonen så må den første være satt til en tom strengverdi';
$strTransformation_image_jpeg__inline = 'Viser et klikkbart tommelfingerbilde; valg: bredde, høyde i piksler (bevarer originale forhold)';
$strTransformation_image_jpeg__link = 'Viser en link til dette bildet (m.a.o. direkte blob-nedlasting).';
$strTransformation_image_png__inline = 'Se image/jpeg: inline';
$strTransformation_text_plain__dateformat = 'Tar et TIME, TIMESTAMP eller DATETIME felt og formaterer det med din lokale dato-/tidsformat. Første valg er avviket (i timer) som vil bli lagt til tidsformatet (Standard: 0). Andre valget er et annet dato-/tidsformat basert på parameterene til PHPs strftime().';
$strTransformation_text_plain__external = 'BARE LINUX: Starter et eksternt program og gir den feltdataene via standard input. Returnerer standart output fra programmet. Standard er Tidy, for å skrive ut pen HTML kode. Av sikkerhetsgrunner så må du redigere fila libraries/transformations/text_plain__external.inc.php og skrive inn de verktøyene du tillater å kjøres. Den første verdien er antall programmer du ønsker å bruke og den andre verdien er parameterene for programmet. Den tredje verdien, hvis den er satt til 1 vil konvertere utskriften med htmlspecialchars() (Standard er 1). En fjerde verdi vil, viss satt til 1 sette en NOWRAP i innholdscellen slik at hele resultatet blir vist uten reformatering (Standard er 1)';
$strTransformation_text_plain__formatted = 'Bevarer original formatering av feltet. Ingen \'escaping\' blir utført.';
$strTransformation_text_plain__imagelink = 'Viser et bilde og en link, feltet inneholder filnavnet; første verdi er et prefiks slik som "http://domain.com/", andre verdien er bredden i piksler, tredje er høyden.';
$strTransformation_text_plain__link = 'Viser en link, feltet inneholder filnavnet, ; første verdi er et prefiks slik som "http://domain.com/", andre verdien er en tittel for linken.';
$strTransformation_text_plain__substr = 'Viser bare en delstreng. Første verdien er antall tegn fra starten hvor din tekst begynner (Standard: 0). Andre verdien er hvor mange tegn som skal returneres. Hvis den er tom så returneres resten av teksten. Den tredje verdien definerer hvilke tegn som vil bli lagt til resultatet når en delstreng blir returnert (Standard: ...).';
$strTransformation_text_plain__unformatted = 'Vis HTML kode som HTML enheter. Ingen HTML formatering blir vist.';
$strTruncateQueries = 'Forkort vist spørring';
$strTurkish = 'tyrkisk';
$strType = 'Type';

$strUkrainian = 'ukrainsk';
$strUncheckAll = 'Fjern merking';
$strUnicode = 'Unicode';
$strUnique = 'Unik';
$strUnknown = 'ukjent';
$strUnselectAll = 'Fjern alle valgte';
$strUpdComTab = 'Les i dokumentasjonen hvordan du oppdaterer din Column_comments tabell';
$strUpdatePrivMessage = 'Du har oppdatert privilegiene til %s.';
$strUpdateProfileMessage = 'Profilen har blitt oppdatert.';
$strUpdateQuery = 'Oppdater spørring';
$strUpgrade = 'Du burde oppgradere til %s %s eller nyere.';
$strUsage = 'Bruk';
$strUseBackquotes = 'Bruk venstre anførselstegn med tabell og feltnavn';
$strUseHostTable = 'Vis vert tabell';
$strUseTabKey = 'Bruk TAB tasten for å flytte fra verdi til verdi, eller CTRL+piltastene for å bevege deg hvor som helst';
$strUseTables = 'Bruk tabeller';
$strUseTextField = 'Bruk tekstfelt';
$strUseThisValue = 'Bruk denne verdien';
$strUser = 'Bruker';
$strUserAlreadyExists = 'Brukeren %s finnes fra før!';
$strUserEmpty = 'Brukernavnet er tomt!';
$strUserName = 'Brukernavn';
$strUserNotFound = 'Den valgte brukeren ble ikke funnet i privilegietabellen.';
$strUserOverview = 'Brukeroversikt';
$strUsersDeleted = 'De valgte brukerne har blitt slettet.';
$strUsersHavingAccessToDb = 'Brukere som har adgang til &quot;%s&quot;';

$strValidateSQL = 'Test SQL';
$strValidatorError = 'SQL-kontrolleren kunne ikke startes. Vennligst sjekk at du har installert de nødvendige php-tilleggene som beskrevet i %sdokumentasjonen%s.';
$strValue = 'Verdi';
$strVar = 'Variabler';
$strViewDump = 'Vis dump (skjema) av tabell';
$strViewDumpDB = 'Vis dump (skjema) av database';
$strViewDumpDatabases = 'Vis dumpet skjema av databaser';

$strWebServerUploadDirectory = 'webtjener opplastingskatalog';
$strWebServerUploadDirectoryError = 'Katalogen du anga for opplasting kan ikke nåes';
$strWelcome = 'Velkommen til %s';
$strWestEuropean = 'vesteuropeisk';
$strWildcard = 'jokertegn';
$strWindowNotFound = 'Målvinduet kunne ikke oppdateres. Muligens du har lukket modervinduet eller din nettleser blokkerer vindu-til-vindu oppdateringer av sikkerhetsårsaker.';
$strWithChecked = 'Med avkrysset:';
$strWritingCommentNotPossible = 'Skriving av kommentar er ikke mulig';
$strWritingRelationNotPossible = 'Skriving av relasjon er ikke mulig';
$strWrongUser = 'Ugyldig brukernavn/passord. Ingen tilgang.';

$strXML = 'XML';

$strYes = 'Ja';

$strZeroRemovesTheLimit = 'Merk: Ved å sette disse til 0 (null) fjernes begrensningen.';
$strZip = 'Komprimert (zip)';

// To translate:
$strAfterInsertNext = 'Edit next row';  //to translate

$strEscapeWildcards = 'Jokertegnene _ og % må beskyttes med en \ for å bruke dem direkte';  //to translate

$strMbExtensionMissing = 'The mbstring PHP extension was not found and you seem to be using multibyte charset. Without mbstring extension phpMyAdmin is unable to split strings correctly and it may result in unexpected results.';  //to translate
$strMbOverloadWarning = 'You have enabled mbstring.func_overload in your PHP configuration. This option is incompatible with phpMyAdmin and might cause breaking of some data!';  //to translate

$strSQLExportCompatibility = 'SQL export compatibility';  //to translate

?>
