<?php
/* $Id: korean-euc-kr.inc.php,v 1.1 2005/02/03 06:03:48 nuhpardon Exp $ */

/* Translated by WooSuhan <kjh@unews.NOSPAM.co.kr> */

$charset = 'euc-kr';
$text_dir = 'ltr';
$left_font_family = '"굴림", sans-serif';
$right_font_family = '"굴림", sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('일', '월', '화', '수', '목', '금', '토');
$month = array('해오름달', '시샘달', '물오름달', '잎새달', '푸른달', '누리달', '견우직녀달', '타오름달', '열매달', '하늘연달', '미틈달', '매듭달');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
// $datefmt = '%y년 %B %d일 %p %I:%M ';
$datefmt = '%y-%m-%d %H:%M ';

$strAPrimaryKey = ' %s에 기본 키가 추가되었습니다';
$strAccessDenied = '접근이 거부되었습니다.';
$strAction = '실행';
$strAddDeleteColumn = '열(칼럼) 추가/삭제';
$strAddDeleteRow = 'Criteria 행(레코드) 추가/삭제';
$strAddNewField = '필드 추가하기';
$strAddPrivilegesOnDb = '다음 데이터베이스에 권한 추가하기';
$strAddPrivilegesOnTbl = '다음 테이블에 권한 추가하기';
$strAddSearchConditions = '검색 조건 추가 ("where" 조건):';
$strAddToIndex = '%s개 열(칼럼)에 인덱스 추가';
$strAddUser = '새 사용자 추가';
$strAddUserMessage = '새 사용자를 추가했습니다.';
$strAffectedRows = '적용된 행(레코드):';
$strAfter = '%s 다음에';
$strAfterInsertBack = '되돌아가기';
$strAfterInsertNewInsert = '새 행(레코드) 삽입하기';
$strAllTableSameWidth = '모든 테이블을 같은 너비로 출력할까요?';
$strAlterOrderBy = '다음 순서대로 테이블 정렬(변경)';
$strAnIndex = '%s 에 인덱스가 걸렸습니다';
$strAnalyzeTable = '테이블 분석';
$strAnd = '그리고';
$strAnyHost = '아무데서나';
$strAnyUser = '아무나';
$strAscending = '오름차순';
$strAtBeginningOfTable = '테이블의 처음';
$strAtEndOfTable = '테이블의 마지막';
$strAttr = '보기';
$strAutodetect = '자동';

$strBack = '뒤로';
$strBinary = '바이너리';
$strBinaryDoNotEdit = ' 바이너리 - 편집 금지 ';
$strBookmarkDeleted = '북마크를 제거했습니다.';
$strBookmarkQuery = '북마크된 SQL 질의';
$strBookmarkThis = '이 SQL 질의를 북마크함';
$strBrowse = '보기';
$strBzError = '이 php 버전의 Bz2 확장모듈이 깨졌기 때문에 phpMyAdmin이 덤프파일을 압축할 수 없습니다. 환경설정파일에서<code>$cfg[\'BZipDump\']</code>를 <code>FALSE</code>로 설정하십시오. 만약 Bz2 압축을 사용하고자 한다면, php버전을 업그레이드해야 합니다. 자세한 내용은 php 버그 리포트 %s 를 보십시오.';
$strBzip = '"bz 압축"';

$strCSVOptions = 'CSV 옵션';
$strCannotLogin = 'MySQL 서버에 로그인할 수 없습니다';
$strCantLoad = ' %s 확장모듈을 불러올 수 없습니다.<br />PHP 환경설정을 검사하십시오.';
$strCantRenameIdxToPrimary = '인덱스 이름을 기본 키로 바꿀 수 없습니다!';
$strCarriage = '캐리지 리턴: \\r';
$strChange = '변경';
$strChangeDisplay = '출력할 필드 선택';
$strChangePassword = '암호 변경';
$strCharsetOfFile = '파일 문자셋:';
$strCheckAll = '모두 체크';
$strCheckPrivs = '사용권한 보기';
$strCheckPrivsLong = '데이터베이스 &quot;%s&quot; 에 대한 사용권한 검사.';
$strCheckTable = '테이블 검사';
$strChoosePage = '편집할 페이지를 선택하세요';
$strColComFeat = '열(칼럼) 설명(코멘트) 출력하기';
$strColumnNames = '열(칼럼) 이름';
$strColumnPrivileges = '열(칼럼)에 관한 권한';
$strComments = '설명(코멘트)';
$strCompleteInserts = '완전한 INSERT문 작성';
$strCompression = '압축';
$strConfigFileError = 'phpMyAdmin이 환경설정 파일을 읽을 수 없습니다!<br />PHP에 에러가 있거나 실제로 그 파일이 없는 경우입니다.<br />아래 링크를 통해 환경설정 파일만 불러들여보십시오. 그리고 PHP 에러 메시지를 확인하십시오. 어딘가에 따옴표(quote)나 세미콜론(;)이 빠져있는 경우가 종종 있습니다.<br />만약 아무것도 보이지 않으면, 정상적인 것입니다.';
$strConnections = '연결 수';
$strCopyTable = '테이블 복사 (데이터베이스명<b>.</b>테이블명):';
$strCopyTableOK = '%s 테이블이 %s 으로 복사되었습니다.';
$strCreate = ' 만들기 ';
$strCreateIndex = '%s 개 열(칼럼)에 인덱스 만들기 ';
$strCreateIndexTopic = '새 인덱스 만들기';
$strCreateNewDatabase = '새 데이터베이스 만들기';
$strCreateNewTable = '데이터베이스 %s에 새로운 테이블을 만듭니다.';
$strCreatePage = '새 페이지 만들기';

$strDBGMaxTimeMs = '최대시간, ms';
$strDBGMinTimeMs = '최소시간, ms';
$strDBGModule = '모듈';
$strData = '데이터';
$strDataDict = '데이터 사전 (전체 구조보기)';
$strDataOnly = '데이터만';
$strDatabase = '데이터베이스';
$strDatabaseHasBeenDropped = '데이터베이스 %s 를 제거했습니다.';
$strDatabases = '데이터베이스 ';
$strDatabasesDropped = '%s 데이터베이스를 삭제했습니다.';
$strDatabasesStats = '데이터베이스 사용량 통계';
$strDatabasesStatsDisable = '통계 숨기기';
$strDatabasesStatsEnable = '통계 보기';
$strDatabasesStatsHeavyTraffic = '주의: 데이터베이스 통계 보기는 웹서버와 MySQL 서버 사이에 큰 부하를 줍니다.';
$strDbPrivileges = '데이터베이스에 관한 권한';
$strDefault = '기본값';
$strDefaultValueHelp = '기본값에는, 역슬래시나 따옴표 없이 단 하나의 값을 넣으십시오. (예: a)';
$strDelete = '삭제';
$strDeleteAndFlush = '사용자를 삭제하고 사용권한을 갱신함.';
$strDeleteAndFlushDescr = '가장 확실한 방법이지만, 사용권한 테이블을 다시 읽어들이는데는 약간의 시간이 걸립니다.';
$strDeleted = '선택한 줄(레코드)을 삭제 하였습니다.';
$strDeletedRows = '지워진 줄(레코드):';
$strDeleting = ' %s 을 삭제합니다';
$strDescending = '내림차순(역순)';
$strDisabled = '사용불가';
$strDisplayOrder = '출력 순서:';
$strDoAQuery = '다음으로 질의를 만들기 (와일드카드: "%")';
$strDoYouReally = '정말로 다음을 실행하시겠습니까? ';
$strDocu = '도움말';
$strDrop = '삭제';
$strDropSelectedDatabases = '선택한 데이터베이스 삭제(Drop)';
$strDropUsersDb = '사용자명과 같은 이름의 데이터베이스를 삭제';
$strDumpXRows = '%s개의 행(레코드)을 덤프 (%s번째 레코드부터).';
$strDumpingData = '테이블의 덤프 데이터';
$strDynamic = '동적(다이내믹)';

$strEdit = '수정';
$strEditPDFPages = 'PDF 페이지 편집';
$strEditPrivileges = '권한 수정';
$strEffective = '실제량';
$strEmpty = '비우기';
$strEmptyResultSet = '결과값이 없습니다. (빈 레코드 리턴.)';
$strEnabled = '사용가능';
$strEnd = '마지막';
$strEnglishPrivileges = ' 주의: MySQL 권한 이름은 영어로 표기되어야 합니다. ';
$strError = '오류';
$strExplain = 'SQL 해석';
$strExport = '내보내기';
$strExtendedInserts = '확장된 inserts';
$strExtra = '추가';

$strFailedAttempts = '실패한 시도';
$strField = '필드';
$strFieldHasBeenDropped = '필드 %s 를 제거했습니다';
$strFields = '필드';
$strFieldsEmpty = ' 필드 갯수가 없습니다! ';
$strFieldsEnclosedBy = '필드 감싸기';
$strFieldsEscapedBy = '필드 특수문자(escape) 처리';
$strFieldsTerminatedBy = '필드 구분자 ';
$strFileCouldNotBeRead = '파일을 읽을 수 없습니다';
$strFileNameTemplate = '파일명 템플릿';
$strFileNameTemplateHelp = '데이터베이스 이름에 __DB__ 를, 테이블명에 __TABLE__ 을, 시간 표기에 %sany strftime%s 옵션을 사용하며, 확장자는 자동으로 추가됩니다. 그밖의 텍스트는 보존됩니다.';
$strFileNameTemplateRemember = '템플릿 기억';
$strFlushTable = '테이블 닫기(캐시 삭제)';
$strFunction = '함수';

$strGenTime = '처리한 시간';
$strGlobalPrivileges = '전체적 권한';
$strGo = '실행';
$strGzip = 'gz 압축';

$strHasBeenAltered = '을(를) 변경하였습니다.';
$strHasBeenCreated = '을(를) 작성하였습니다.';
$strHaveToShow = '출력하려면 적어도 1개 이상의 열(칼럼)을 선택해야 합니다.';
$strHome = '시작페이지';
$strHomepageOfficial = 'phpMyAdmin 공식 홈';
$strHost = '호스트';
$strHostEmpty = '호스트명이 없습니다!';

$strIfYouWish = '테이블 열(칼럼)에 데이터를 추가할 때는 필드 목록을 콤마로 구분해 주십시요. ';
$strIgnore = 'Ignore';
$strIgnoringFile = '파일 %s 을 무시합니다';
$strImportFiles = '파일 가져오기';
$strImportFinished = '가져오기가 끝났습니다';
$strInUse = '사용중';
$strIndex = '인덱스';
$strIndexHasBeenDropped = '인덱스 %s 를 제거했습니다';
$strIndexName = '인덱스 이름:';
$strIndexType = '인덱스 종류:';
$strIndexes = '인덱스';
$strInsecureMySQL = '환경설정파일에 MySQL 관리자 암호가 없습니다. 이같은 기본설정상태로 MySQL 서버가 작동한다면 누구나 침입할 수 있으므로, 이 보안상 허점을 수정하시기 바랍니다.';
$strInsert = '삽입';
$strInsertAsNewRow = '새 열을 삽입합니다';
$strInsertNewRow = '새 열을 삽입';
$strInsertTextfiles = '텍스트파일을 읽어서 테이블에 데이터 삽입';
$strInsertedRows = '삽입된 열:';
$strInstructions = '설명서';

$strJumpToDB = '데이터베이스 &quot;%s&quot; 로 이동.';
$strJustDelete = '권한 테이블에서 사용자를 삭제하기만 함.';
$strJustDeleteDescr = '사용권한이 갱신되기까지는 &quot;삭제된&quot; 사용자들도 여전히 서버를 사용할 수 있습니다.';

$strKeepPass = '암호를 변경하지 않음';
$strKeyname = '키 이름';
$strKill = 'Kill';

$strLengthSet = '길이/값*';
$strLimitNumRows = '페이지당 레코드 수';
$strLineFeed = '줄(열)바꿈 문자: \\n';
$strLinesTerminatedBy = '줄(열) 구분자';
$strLocalhost = 'Local';
$strLocationTextfile = 'SQL 텍스트파일의 위치';
$strLogPassword = '암호:';
$strLogUsername = '사용자명:';
$strLogin = '로그인';
$strLoginInformation = '로그인 정보';
$strLogout = '로그아웃';

$strModifications = '수정된 내용이 저장되었습니다.';
$strModify = '수정';
$strModifyIndexTopic = '인덱스 수정';
$strMoreStatusVars = '그밖의 상태 값';
$strMoveTable = '테이블 이동 (데이터베이스명<b>.</b>테이블명):';
$strMoveTableOK = '테이블 %s 을 %s 로 옮겼습니다.';
$strMySQLCharset = 'MySQL 문자셋';
$strMySQLReloaded = 'MySQL을 재시동했습니다.';
$strMySQLSaid = 'MySQL 메시지: ';
$strMySQLServerProcess = '%pma_s2% (MySQL %pma_s1%)에 %pma_s3% 계정으로 들어왔습니다.';
$strMySQLShowProcess = 'MySQL 프로세스 보기';
$strMySQLShowStatus = 'MySQL 런타임 상태 보기';
$strMySQLShowVars = 'MySQL 환경설정값 보기';

$strName = '이름';
$strNext = '다음';
$strNo = ' 아니오 ';
$strNoDatabases = '데이터베이스가 없습니다';
$strNoDatabasesSelected = '데이터베이스를 선택하지 않았습니다.';
$strNoDescription = '설명이 없습니다';
$strNoDropDatabases = '"DROP DATABASE" 구문은 허락되지 않습니다.';
$strNoExplain = '해석(EXPLAIN) 생략';
$strNoFrames = 'phpMyAdmin 은 <b>프레임을 지원하는</b> 브라우저에서 잘 보입니다.';
$strNoIndex = '인덱스가 설정되지 않았습니다!';
$strNoModification = '변화 없음';
$strNoPassword = '암호 없음';
$strNoPhp = 'PHP 코드 없이 보기';
$strNoPrivileges = '권한 없음';
$strNoQuery = 'SQL 질의 없음!';
$strNoRights = '어떻게 들어오셨어요? 지금 여기 있을 권한이 없습니다!';
$strNoTablesFound = '데이터베이스에 테이블이 없습니다.';
$strNoUsersFound = '사용자가 없습니다.';
$strNone = '없음';
$strNotNumber = '은 숫자(번호)가 아닙니다!';
$strNotValidNumber = '은 올바른 열 번호가 아닙니다!';
$strNumTables = '테이블 수';

$strOperations = '테이블 작업';
$strOptimizeTable = '테이블 최적화';
$strOptionalControls = '특수문자 읽기/쓰기 옵션';
$strOptionally = '옵션입니다.';
$strOr = '또는';
$strOverhead = '부담';

$strPHP40203 = 'PHP 4.2.3에는 멀티바이트 문자열(mbstring) 모듈에 버그가 있으므로 추천하지 않습니다. PHP 버그 리포트 19404를 보십시오.';
$strPHPVersion = 'PHP 버전';
$strPageNumber = '페이지:';
$strPassword = '암호';
$strPasswordChanged = '%s 의 암호가 바뀌었습니다.';
$strPasswordEmpty = '암호가 비었습니다!';
$strPasswordNotSame = '암호가 동일하지 않습니다!';
$strPdfDbSchema = '"%s" 데이터베이스의 스킴(윤곽) - 페이지 %s';
$strPdfInvalidTblName = '"%s" 테이블이 존재하지 않습니다!';
$strPdfNoTables = '테이블이 없습니다';
$strPhp = 'PHP 코드 보기';
$strPmaDocumentation = 'phpMyAdmin 설명서';
$strPmaUriError = '환경설정 파일에서 <tt>$cfg[\'PmaAbsoluteUri\']</tt> 주소를 기입하십시오!';
$strPos1 = '처음';
$strPrevious = '이전';
$strPrimary = '기본';
$strPrimaryKeyHasBeenDropped = '기본 키를 제거했습니다';
$strPrimaryKeyName = '기본 키의 이름은 반드시 PRIMARY여야 합니다!';
$strPrimaryKeyWarning = '("PRIMARY"는 기본 키만의 <b>유일한</b> 이름입니다!)';
$strPrint = '인쇄';
$strPrintView = '인쇄용 보기';
$strPrivDescAllPrivileges = 'GRANT 이외의 모든 권한을 포함함.';
$strPrivDescAlter = '테이블 구조 변경 허용.';
$strPrivDescCreateDb = 'DB 및 테이블 생성 허용.';
$strPrivDescCreateTbl = '테이블 생성 허용.';
$strPrivDescCreateTmpTable = '임시테이블 생성 허용.';
$strPrivDescDelete = '데이터 삭제 허용.';
$strPrivDescDropDb = 'DB 및 테이블 삭제 허용.';
$strPrivDescDropTbl = '테이블 삭제 허용.';
$strPrivDescExecute = '저장프로시저(SP) 사용을 허용; 이 MySQL 버전에는 효과가 없음.';
$strPrivDescFile = '데이터를 파일에서 가져오기 및 파일로 내보내기 허용.';
$strPrivDescGrant = '권한 테이블을 갱신하지 않고 사용자와 권한 추가하기 허용.';
$strPrivDescIndex = '인덱스 생성 및 삭제 허용.';
$strPrivDescInsert = '데이터 추가(insert) 및 변경(replace) 허용.';
$strPrivDescLockTables = '현재 쓰레드에 대한 테이블 잠금(lock) 허용.';
$strPrivDescMaxConnections = 'Limits the number of new connections the user may open per hour.';
$strPrivDescMaxQuestions = 'Limits the number of queries the user may send to the server per hour.';
$strPrivDescMaxUpdates = 'Limits the number of commands that change any table or database the user may execute per hour.';
$strPrivDescProcess3 = '다른 사용자의 프로세스 죽이기를 허용.';
$strPrivDescReferences = '이 버전의 MySQL에는 소용이 없습니다.';
$strPrivDescReload = '캐시를 비우고 서버를 재시동하는 것을 허용.';
$strPrivDescReplSlave = '복제서버(replication slaves)에 필요합니다.';
$strPrivDescSelect = '데이터 읽기 허용.';
$strPrivDescShowDb = '전체 데이터베이스 목록 접근을 허용';
$strPrivDescShutdown = '서버 종료 허용.';
$strPrivDescUpdate = '데이터 변경 허용.';
$strPrivDescUsage = '권한 없음.';
$strPrivileges = '사용권한';
$strPrivilegesReloaded = '권한을 다시 로딩했습니다.';
$strProcesslist = '프로세스 목록';
$strPutColNames = '맨처음에 필드 이름을 출력';

$strQBE = '질의 마법사';
$strQBEDel = '삭제';
$strQBEIns = '삽입';
$strQueryFrame = '질의 창';
$strQueryOnDb = '데이터베이스 <b>%s</b>에 SQL 질의:';
$strQuerySQLHistory = 'SQL 내력(히스토리)';
$strQueryStatistics = '<b>SQL 질의 통계</b>: 이 서버에 %s 번의 질의가 보내졌습니다.';
$strQueryTime = '질의 실행시간 %01.4f 초';
$strQueryType = '질의 종류';

$strReType = '재입력';
$strReceived = '받음';
$strRecords = '레코드수';
$strReferentialIntegrity = 'referential 무결성 검사:';
$strRelationNotWorking = 'linked Tables에서 작동하는 부가기능이 사용되지 않습니다. 이유를 알려면 %s여기를 클릭%s하십시오.';
$strReloadFailed = 'MySQL 재시동에 실패하였습니다.';
$strReloadMySQL = 'MySQL 재시동';
$strReloadingThePrivileges = '사용권한을 갱신합니다(Reloading the privileges)';
$strRemoveSelectedUsers = '선택한 사용자를 삭제';
$strRenameTable = '테이블 이름 바꾸기';
$strRenameTableOK = '테이블 %s을(를) %s(으)로 변경하였습니다.';
$strRepairTable = '테이블 복구';
$strReplace = '대치(Replace)';
$strReplaceTable = '파일로 테이블 대치하기';
$strReset = '리세트';
$strResourceLimits = '리소스 제한';
$strRevoke = '제거';
$strRevokeAndDelete = '모든 활성화된 권한을 박탈하고 사용자를 삭제함.';
$strRevokeAndDeleteDescr = '사용권한이 다시 로딩되기까지는 이 사용자들은 여전히 USAGE 권한을 갖고 있습니다.';
$strRevokeMessage = '%s의 권한을 제거했습니다.';
$strRowLength = '행 길이';
$strRowSize = ' Row size ';
$strRows = '행(레코드)';
$strRowsFrom = '행. 시작(행)위치';
$strRowsModeFlippedHorizontal = '수평 (rotated headers)';
$strRowsModeHorizontal = '수평(가로)';
$strRowsModeOptions = ' %s 정렬 (%s 칸이 넘으면 헤더 반복)';
$strRowsModeVertical = '수직(세로)';
$strRowsStatistic = '행(레코드) 통계';
$strRunQuery = '질의 실행';
$strRunSQLQuery = '데이터베이스 %s에 SQL 질의를 실행';
$strRunning = '입니다. (%s)';

$strSQL = 'SQL';
$strSQLOptions = 'SQL 옵션';
$strSQLParserUserError = 'SQL 질의문에 에러가 있습니다. MySQL 서버가 다음과 같은 에러를 출력했습니다. 이것이 문제를 진단하는데 도움이 될 것입니다.';
$strSQLQuery = 'SQL 질의';
$strSQLResult = 'SQL 결과';
$strSQPBugInvalidIdentifer = '잘못된 식별자(Identifer)';
$strSQPBugUnclosedQuote = '따옴표(quote)가 닫히지 않았음';
$strSave = '저장';
$strSearch = '검색';
$strSearchFormTitle = '데이터베이스 검색';
$strSearchInTables = '찾을 테이블:';
$strSearchNeedle = '찾을 단어, 값 (와일드카드: "%"):';
$strSearchOption1 = '아무 단어나';
$strSearchOption2 = '모든 단어';
$strSearchOption3 = '정확한 문구';
$strSearchOption4 = '정규표현식';
$strSearchType = '찾는 방식:';
$strSelectADb = '데이터베이스를 선택하세요';
$strSelectAll = '모두 선택';
$strSelectFields = '필드 선택 (하나 이상):';
$strSelectNumRows = '질의(in query)';
$strSend = '파일로 저장';
$strSent = '보냄';
$strServer = '서버';
$strServerChoice = '서버 선택';
$strServerStatus = '런타임 정보';
$strServerStatusUptime = '이 MySQL 서버는 %s 동안 구동되었습니다. <br/>구동 시작날짜는 %s 입니다.';
$strServerTabProcesslist = '프로세스 목록';
$strServerTabVariables = '환경설정값';
$strServerTrafficNotes = '<b>서버 소통량</b>: 이 테이블은 MySQL서버가 구동된 이래의 네트웍 부하 상태를 보여줍니다.';
$strServerVars = '서버의 환경설정';
$strServerVersion = '서버 버전';
$strSessionValue = '세션 값';
$strSetEnumVal = '필드 종류가 "enum"이나 "set"일 경우, 다음과 같은 형식으로 값을 입력하십시오: \'a\',\'b\',\'c\'...<br />여기에 역슬래시(\)나 작은 따옴표(\')를 넣어야 한다면, 그 앞에 역슬래시를 사용하십시오. (예: \'\\\\xyz\' 또는 \'a\\\'b\').';
$strShow = '보기';
$strShowAll = '모두 보기';
$strShowColor = '색깔 보기';
$strShowGrid = 'grid 보기';
$strShowPHPInfo = 'PHP 정보 보기';
$strShowTables = '테이블 보기';
$strShowThisQuery = ' 이 질의를 다시 보여줌 ';
$strShowingRecords = '행(레코드) 보기';
$strSingly = '(단독으로)';
$strSize = '크기';
$strSort = '정렬';
$strSpaceUsage = '공간 사용량';
$strSplitWordsWithSpace = '단어는 스페이스(" ")로 구분됩니다.';
$strStatCheckTime = '검사';
$strStatCreateTime = '생성';
$strStatUpdateTime = '업데이트';
$strStatement = '명세';
$strStatus = '상태';
$strStrucCSV = 'CSV 데이터';
$strStrucData = '구조와 데이터 모두';
$strStrucDrop = '\'DROP TABLE\'문 추가';
$strStrucExcelCSV = 'MS엑셀 CSV 데이터';
$strStrucOnly = '구조만';
$strStructPropose = '제안하는 테이블 구조';
$strStructure = '구조';
$strSubmit = '확인';
$strSuccess = 'SQL 질의가 바르게 실행되었습니다.';
$strSum = '계';
$strSwitchToTable = '복사한 테이블로 옮겨감';

$strTable = '테이블 ';
$strTableComments = '테이블 설명';
$strTableEmpty = '테이블명이 없습니다!';
$strTableHasBeenDropped = '테이블 %s 을 제거했습니다.';
$strTableHasBeenEmptied = '테이블 %s 을 비웠습니다';
$strTableHasBeenFlushed = '테이블 %s 을 닫았습니다(캐시 삭제)';
$strTableMaintenance = '테이블 유지보수';
$strTableStructure = '테이블 구조';
$strTableType = '테이블 종류';
$strTables = '테이블 %s 개';
$strTblPrivileges = '테이블에 관한 권한';
$strTextAreaLength = ' 필드의 길이 때문에,<br />이 필드를 편집할 수 없습니다 ';
$strTheContent = '파일 내용을 삽입하였습니다.';
$strTheContents = '파일 내용이 선택한 테이블의 프라이머리 혹은 고유값 키와 일치하는 열을 대치(代置)시키겠습니다.';
$strTheTerminator = '필드 종료 기호.';
$strThisNotDirectory = '디렉토리가 아닙니다';
$strThreadSuccessfullyKilled = '쓰레드 %s 를 죽였습니다.';
$strTime = '시간';
$strTotal = '합계';
$strTotalUC = '전체 사용량';
$strTraffic = '소통량';
$strType = '종류';

$strUncheckAll = '모두 체크안함';
$strUnique = '고유값';
$strUnselectAll = '모두 선택안함';
$strUpdatePrivMessage = '%s 의 권한을 업데이트했습니다.';
$strUpdateProfileMessage = '프로파일을 업데이트했습니다.';
$strUpdateQuery = '질의 업데이트';
$strUsage = '사용법(량)';
$strUseBackquotes = '테이블, 필드명에 백쿼터(`) 사용';
$strUseTables = '사용할 테이블';
$strUser = '사용자';
$strUserAlreadyExists = '사용자 %s 가 이미 존재합니다!';
$strUserEmpty = '사용자명이 없습니다!';
$strUserName = '사용자명';
$strUserNotFound = '선택한 사용자는 사용권한 테이블에 존재하지 않습니다.';
$strUserOverview = '사용자 개요';
$strUsersDeleted = '선택한 사용자들을 삭제했습니다.';
$strUsersHavingAccessToDb = '&quot;%s&quot; 에 접근할 수 있는 사용자들';

$strValidateSQL = 'SQL 검사';
$strValidatorError = 'SQL 검사기가 초기화되지 않았습니다. %s문서%s에서 설명한 php 확장모듈을 설치했는지 확인해보십시오.';
$strValue = '값';
$strVar = '변수';
$strViewDump = '테이블의 덤프(스키마) 데이터 보기';
$strViewDumpDB = '데이터베이스의 덤프(스키마) 데이터 보기';

$strWebServerUploadDirectory = '웹서버 업로드 디렉토리';
$strWebServerUploadDirectoryError = '업로드 디렉토리에 접근할 수 없습니다';
$strWelcome = '%s에 오셨습니다';
$strWithChecked = '선택한 것을:';
$strWrongUser = '사용자명/암호가 틀렸습니다. 접근이 거부되었습니다.';

$strYes = ' 예 ';

$strZeroRemovesTheLimit = '주의: 이 옵션을 0으로 하면 제한이 없어집니다.';
$strZip = 'zip 압축';
$timespanfmt = '%s days, %s hours, %s minutes and %s seconds'; //to translate

$strAbortedClients = 'Aborted'; //to translate
$strAbsolutePathToDocSqlDir = 'Please enter the absolute path on webserver to docSQL directory';  //to translate
$strAddedColumnComment = 'Added comment for column';  //to translate
$strAddedColumnRelation = 'Added relation for column';  //to translate
$strAdministration = 'Administration'; //to translate
$strAll = 'All'; // To translate
$strAny = 'Any'; // To translate
$strAutomaticLayout = 'Automatic layout';  //to translate

$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate
$strBookmarkLabel = 'Label'; // To translate
$strBookmarkView = 'View only'; // To translate

$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';  //to translate
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';  //to translate
$strCardinality = 'Cardinality'; // To translate
$strChangeCopyMode = 'Create a new user with the same privileges and ...';  //to translate
$strChangeCopyModeCopy = '... keep the old one.';  //to translate
$strChangeCopyModeDeleteAndReload = ' ... delete the old one from the user tables and reload the privileges afterwards.';  //to translate
$strChangeCopyModeJustDelete = ' ... delete the old one from the user tables.';  //to translate
$strChangeCopyModeRevoke = ' ... revoke all active privileges from the old one and delete it afterwards.';  //to translate
$strChangeCopyUser = 'Change Login Information / Copy User';  //to translate
$strCharset = 'Charset';  //to translate
$strCommand = 'Command'; //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strCookiesRequired = '쿠키 사용이 가능해야 합니다 past this point.'; // To translate
$strCopyTableSameNames = 'Can\'t copy table to same one!';  //to translate
$strCouldNotKill = 'phpMyAdmin was unable to kill thread %s. It probably has already been closed.'; //to translate
$strCreatePdfFeat = 'Creation of PDFs';  //to translate
$strCriteria = 'Criteria'; // To translate

$strDBComment = 'Database comment: ';//to translate
$strDBGContext = 'Context';  //to translate
$strDBGContextID = 'Context ID';  //to translate
$strDBGHits = 'Hits';  //to translate
$strDBGLine = 'Line';  //to translate
$strDBGTimePerHitMs = 'Time/Hit, ms';  //to translate
$strDBGTotalTimeMs = 'Total time, ms';  //to translate
$strDbSpecific = 'database-specific';  //to translate
$strDelOld = 'The current Page has References to Tables that no longer exist. Would you like to delete those References?';  //to translate
$strDisplayFeat = 'Display Features';  //to translate
$strDisplayPDF = 'Display PDF schema';  //to translate
$strDumpSaved = 'Dump has been saved to file %s.';  //to translate

$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate

$strFileAlreadyExists = 'File %s already exists on server, change filename or check overwrite option.';  //to translate
$strFixed = 'fixed'; // To translate
$strFlushPrivilegesNote = '주의: phpMyAdmin은 사용자의 사용권한을 MySQL의 사용권한 테이블에서 곧바로 읽어옵니다. The content of this tables may differ from the privileges the server uses if manual changes have made to it. In this case, you should %sreload the privileges%s before you continue.'; //to translate
$strFormEmpty = 'Missing value in the form !'; // To translate
$strFormat = 'Format'; // To translate
$strFullText = 'Full Texts'; // To translate

$strGenBy = 'Generated by'; //to translate
$strGeneralRelationFeat = 'General 관계 features';  //to translate
$strGlobal = 'global';  //to translate
$strGlobalValue = 'Global value'; //to translate
$strGrantOption = 'Grant'; //to translate

$strId = 'ID'; //to translate
$strIdxFulltext = 'Fulltext'; // To translate
$strImportDocSQL = 'Import docSQL Files';  //to translate
$strInnodbStat = 'InnoDB 상태';  //to translate
$strInsertedRowId = 'Inserted row id:';  //to translate

$strLaTeX = 'LaTeX';  //to translate
$strLaTeXOptions = 'LaTeX options';  //to translate
$strLandscape = 'Landscape';  //to translate
$strLinkNotFound = 'Link not found';  //to translate
$strLinksTo = 'Links to';  //to translate

$strMIME_MIMEtype = 'MIME-type';//to translate
$strMIME_available_mime = 'Available MIME-types';//to translate
$strMIME_available_transform = 'Available transformations';//to translate
$strMIME_description = 'Description';//to translate
$strMIME_nodescription = 'No Description is available for this transformation.<br />Please ask the author, what %s does.';//to translate
$strMIME_transformation = 'Browser transformation';//to translate
$strMIME_transformation_note = 'For a list of available transformation options and their MIME-type transformations, click on %stransformation descriptions%s';//to translate
$strMIME_transformation_options = 'Transformation options';//to translate
$strMIME_transformation_options_note = 'Please enter the values for transformation options using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';//to translate
$strMIME_without = 'MIME-types printed in italics do not have a seperate transformation function';//to translate
$strMoveTableSameNames = 'Can\'t move table to same one!';  //to translate
$strMustSelectFile = 'You should select file which you want to insert.';  //to translate

$strNoIndexPartsDefined = 'No index parts defined!'; // To translate
$strNoOptions = 'This format has no options';//to translate
$strNoPermission = 'The web server does not have permission to save the file %s.';  //to translate
$strNoSpace = 'Insufficient space to save the file %s.';  //to translate
$strNoValidateSQL = 'Skip Validate SQL';  //to translate
$strNotOK = 'not OK';  //to translate
$strNotSet = '<b>%s</b> 테이블이 없거나 or not set in %s';  //to translate
$strNull = 'Null'; // To translate
$strNumSearchResultsInTable = '%s match(es) inside table <i>%s</i>';//to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate

$strOK = 'OK';  //to translate
$strOftenQuotation = 'Often quotation marks. 옵션(OPTIONALLY)은 char 및 varchar 필드값을 따옴표(")문자로 닫는다는 것을 뜻합니다.';  // To translate
$strOverwriteExisting = 'Overwrite existing file(s)';  //to translate

$strPartialText = 'Partial Texts'; // To translate
$strPerHour = 'per hour'; //to translate
$strPerMinute = 'per minute';//to translate
$strPerSecond = 'per second';//to translate
$strPortrait = 'Portrait';  //to translate
$strPrivDescProcess4 = 'Allows viewing the complete queries in the process list.'; //to translate
$strPrivDescReplClient = 'Gives the right to the user to ask where the slaves / masters are.'; //to translate
$strPrivDescSuper = '최대 연결수를 초과했을 경우에도 연결을 허용; Required for most administrative operations like setting global variables or killing threads of other users.'; //to translate


$strRelationView = 'Relation view';  //to translate
$strRelationalSchema = 'Relational schema';  //to translate
$strRelations = 'Relations';  //to translate

$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate
$strSaveOnServer = 'Save on server in %s directory';  //to translate
$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';//to translate
$strSelectTables = 'Select Tables';  //to translate
$strShowDatadictAs = 'Data Dictionary Format';  //to translate
$strShowFullQueries = 'Show Full Queries';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate

$strTableOfContents = 'Table of contents';  //to translate
$strThisHost = 'This Host'; //to translate
$strTransformation_image_jpeg__inline = 'Displays a clickable thumbnail; options: width,height in pixels (keeps the original ratio)';  //to translate
$strTransformation_image_jpeg__link = 'Displays a link to this image (direct blob download, i.e.).';//to translate
$strTransformation_image_png__inline = 'See image/jpeg: inline';  //to translate
$strTransformation_text_plain__dateformat = 'Takes a TIME, TIMESTAMP or DATETIME field and formats it using your local dateformat. First option is the offset (in hours) which will be added to the timestamp (Default: 0). Second option is a different dateformat according to the parameters available for PHPs strftime().';//to translate
$strTransformation_text_plain__external = 'LINUX ONLY: 외부 프로그램을 실행하고 표준 입력으로 fielddata 를 공급합니다. Returns standard output of the application. Default is Tidy, to pretty print HTML code. For security reasons, you have to manually edit the file libraries/transformations/text_plain__external.inc.php and insert the tools you allow to be run. The first option is then the number of the program you want to use and the second option are the parameters for the program. The third parameter, if set to 1 will convert the output using htmlspecialchars() (Default is 1). A fourth parameter, if set to 1 will put a NOWRAP to the content cell so that the whole output will be shown without reformatting (Default 1)';//to translate
$strTransformation_text_plain__formatted = 'Preserves original formatting of the field. No Escaping is done.';//to translate
$strTransformation_text_plain__imagelink = 'Displays an image and a link, the field contains the filename; first option is a prefix like "http://domain.com/", second option is the width in pixels, third is the height.';  //to translate
$strTransformation_text_plain__link = 'Displays a link, the field contains the filename; first option is a prefix like "http://domain.com/", second option is a title for the link.';  //to translate
$strTransformation_text_plain__substr = 'Only shows part of a string. First option is an offset to define where the output of your text starts (Default 0). Second option is an offset how much text is returned. If empty, returns all the remaining text. The third option defines which chars will be appended to the output when a substring is returned (Default: ...) .';//to translate
$strTransformation_text_plain__unformatted = 'Displays HTML code as HTML entities. No HTML formatting is shown.';//to translate
$strTruncateQueries = 'Truncate Shown Queries';  //to translate

$strUpdComTab = 'Please see Documentation on how to update your Column_comments Table';  //to translate
$strUseHostTable = 'Use Host Table';  //to translate
$strUseTextField = 'Use text field'; //to translate

$strWildcard = 'wildcard';  //to translate
$strWritingCommentNotPossible = 'Writing of comment not possible';  //to translate
$strWritingRelationNotPossible = 'Writing of relation not possible';  //to translate

$strXML = 'XML';//to translate

$strLoadMethod = 'LOAD method';  //to translate
$strLoadExplanation = 'The best method is checked by default, but you can change if it fails.';  //to translate
$strExecuteBookmarked = 'Execute bookmarked query';  //to translate
$strExcelOptions = 'Excel options';  //to translate
$strReplaceNULLBy = 'Replace NULL by';  //to translate
$strQueryWindowLock = 'Do not overwrite this query from outside the window';  //to translate
$strPaperSize = 'Paper size';  //to translate
$strDatabaseNoTable = 'This database contains no table!';//to translate
$strViewDumpDatabases = 'View dump (schema) of databases';//to translate
$strAddIntoComments = 'Add into comments';//to translate
$strDatabaseExportOptions = 'Database export options';//to translate
$strAddDropDatabase = 'Add DROP DATABASE';//to translate
$strToggleScratchboard = 'toggle scratchboard';  //to translate
$strTableOptions = 'Table options';  //to translate
$strSecretRequired = 'The configuration file now needs a secret passphrase (blowfish_secret).';  //to translate
$strAccessDeniedExplanation = 'phpMyAdmin tried to connect to the MySQL server, and the server rejected the connection. You should check the host, username and password in config.inc.php and make sure that they correspond to the information given by the administrator of the MySQL server.';  //to translate
$strAddAutoIncrement = 'Add AUTO_INCREMENT value';  //to translate
$strCharsets = 'Charsets';  //to translate
$strDescription = 'Description';  //to translate
$strCharsetsAndCollations = 'Character Sets and Collations';  //to translate
$strCollation = 'Collation';  //to translate
$strMultilingual = 'multilingual';  //to translate
$strGerman = 'German';  //to translate
$strPhoneBook = 'phone book';  //to translate
$strDictionary = 'dictionary';  //to translate
$strSwedish = 'Swedish';  //to translate
$strDanish = 'Danish';  //to translate
$strCzech = 'Czech';  //to translate
$strTurkish = 'Turkish';  //to translate
$strEnglish = 'English';  //to translate
$strHungarian = 'Hungarian';  //to translate
$strCroatian = 'Croatian';  //to translate
$strBulgarian = 'Bulgarian';  //to translate
$strLithuanian = 'Lithuanian';  //to translate
$strEstonian = 'Estonian';  //to translate
$strCaseInsensitive = 'case-insensitive';  //to translate
$strCaseSensitive = 'case-sensitive';  //to translate
$strUkrainian = 'Ukrainian';  //to translate
$strHebrew = 'Hebrew';  //to translate
$strWestEuropean = 'West European';  //to translate
$strCentralEuropean = 'Central European';  //to translate
$strTraditionalChinese = 'Traditional Chinese';  //to translate
$strCyrillic = 'Cyrillic';  //to translate
$strArmenian = 'Armenian';  //to translate
$strArabic = 'Arabic';  //to translate
$strRussian = 'Russian';  //to translate
$strUnknown = 'unknown';  //to translate
$strBaltic = 'Baltic';  //to translate
$strUnicode = 'Unicode';  //to translate
$strSimplifiedChinese = 'Simplified Chinese';  //to translate
$strKorean = 'Korean';  //to translate
$strGreek = 'Greek';  //to translate
$strJapanese = 'Japanese';  //to translate
$strThai = 'Thai';  //to translate
$strUseThisValue = 'Use this value';  //to translate
$strWindowNotFound = 'The target browser window could not be updated. Maybe you have closed the parent window or your browser is blocking cross-window updates of your security settings';  //to translate
$strBrowseForeignValues = 'Browse foreign values';  //to translate
$strInternalRelations = 'Internal relations';  //to translate
$strInternalNotNecessary = '* An internal relation is not necessary when it exists also in InnoDB.';  //to translate
$strUpgrade = 'You should upgrade to %s %s or later.';  //to translate
$strLatexStructure = 'Structure of table __TABLE__';//to translate
$strLatexContinued = '(continued)';//to translate
$strLatexContent = 'Content of table __TABLE__';//to translate
$strLatexIncludeCaption = 'Include table caption';//to translate
$strLatexCaption = 'Table caption';//to translate
$strLatexLabel = 'Label key';//to translate
$strLatexContinuedCaption = 'Continued table caption';//to translate

$strPrintViewFull = 'Print view (with full texts)';  //to translate
$strLogServer = 'Server';  //to translate
$strSortByKey = 'Sort by key';  //to translate
$strBookmarkAllUsers = 'Let every user access this bookmark';  //to translate
$strConstraintsForDumped = 'Constraints for dumped tables';  //to translate
$strConstraintsForTable = 'Constraints for table';  //to translate
$strBookmarkOptions = 'Bookmark options';  //to translate
$strCreationDates = 'Creation/Update/Check dates';  //to translate
$strCheckOverhead = 'Check overheaded';  //to translate
$strExcelEdition = 'Excel edition';  //to translate
$strDelayedInserts = 'Use delayed inserts';  //to translate
$strSQLExportType = 'Export type';  //to translate
$strAddConstraints = 'Add constraints';  //to translate
$strGeorgian = 'Georgian';  //to translate
$strCzechSlovak = 'Czech-Slovak';  //to translate
$strTransformation_application_octetstream__download = 'Display a link to download the binary data of a field. First option is the filename of the binary file. Second option is a possible fieldname of a table row containing the filename. If you provide a second option you need to have the first option set to an empty string';  //to translate
$strMaximumSize = 'Maximum size: %s%s';  //to translate
$strConnectionError = 'Cannot connect: invalid settings.';  //to translate
$strDropDatabaseStrongWarning = 'You are about to DESTROY a complete database!';  //to translate
$strAddHeaderComment = 'Add custom comment into header (\\n splits lines)';  //to translate
$strNeedPrimaryKey = 'You should define a primary key for this table.';  //to translate
$strIgnoreInserts = 'Use ignore inserts';  //to translate
$strAddIfNotExists = 'Add IF NOT EXISTS';  //to translate
$strCommentsForTable = 'COMMENTS FOR TABLE';  //to translate
$strMIMETypesForTable = 'MIME TYPES FOR TABLE';  //to translate
$strRelationsForTable = 'RELATIONS FOR TABLE';  //to translate
$strAfterInsertSame = 'Go back to this page';  //to translate
$strRenameDatabaseOK = 'Database %s has been renamed to %s';  //to translate
$strDatabaseEmpty = 'The database name is empty!';  //to translate
$strDBRename = 'Rename database to';  //to translate
$strOperator = 'Operator';  //to translate
$strEncloseInTransaction = 'Enclose export in a transaction';  //to translate
$strCalendar = 'Calendar';  //to translate
$strRefresh = 'Refresh';  //to translate
$strDefragment = 'Defragment table';  //to translate
$strNoRowsSelected = 'No rows selected';  //to translate
$strSpanish = 'Spanish';  //to translate
$strStrucNativeExcel = 'Native MS Excel data';  //to translate
$strDisableForeignChecks = 'Disable foreign key checks';  //to translate
$strServerNotResponding = 'The server is not responding';  //to translate
$strTheme = 'Theme / Style';  //to translate
$strTakeIt = 'take it';  //to translate
$strHexForBinary = 'Use hexadecimal for binary fields';  //to translate
$strIcelandic = 'Icelandic';  //to translate
$strLatvian = 'Latvian';  //to translate
$strPolish = 'Polish';  //to translate
$strRomanian = 'Romanian';  //to translate
$strSlovenian = 'Slovenian';  //to translate
$strTraditionalSpanish = 'Traditional Spanish';  //to translate
$strSlovak = 'Slovak';  //to translate
$strMySQLConnectionCollation = 'MySQL connection collation';  //to translate
$strPersian = 'Persian';  //to translate
$strAddFields = 'Add %s field(s)';  //to translate
$strInsertBookmarkTitle = 'Please insert bookmark title';  //to translate
$strNoThemeSupport = 'No themes support, please check your configuration and/or your themes in directory %s.';  //to translate
$strUseTabKey = 'Use TAB key to move from value to value, or CTRL+arrows to move anywhere';  //to translate
$strEscapeWildcards = 'Wildcards _ and % should be escaped with a \ to use them literally';  //to translate
$strBinLogName = 'Log name';  //to translate
$strBinLogPosition = 'Position';  //to translate
$strBinLogEventType = 'Event type';  //to translate
$strBinLogServerId = 'Server ID';  //to translate
$strBinLogOriginalPosition = 'Original position';  //to translate
$strBinLogInfo = 'Information';  //to translate
$strBinaryLog = 'Binary log';  //to translate
$strSelectBinaryLog = 'Select binary log to view';  //to translate
$strDBCopy = 'Copy database to';  //to translate
$strCopyDatabaseOK = 'Database %s has been copied to %s';  //to translate
$strSwitchToDatabase = 'Switch to copied database';  //to translate
$strPasswordHashing = 'Password Hashing';  //to translate
$strCompatibleHashing = 'MySQL&nbsp;4.0 compatible';  //to translate
$strIndexWarningPrimary = 'PRIMARY and INDEX keys should not both be set for column `%s`';//to translate
$strIndexWarningUnique = 'UNIQUE and INDEX keys should not both be set for column `%s`';//to translate
$strIndexWarningMultiple = 'More than one %s key was created for column `%s`';//to translate
$strIndexWarningTable = 'Problems with indexes of table `%s`';//to translate
$strNoActivity = 'No activity since %s seconds or more, please login again';  //to translate
$strApproximateCount = 'May be approximate. See FAQ 3.11';  //to translate
$strSQLExportCompatibility = 'SQL export compatibility';  //to translate
$strMbOverloadWarning = 'You have enabled mbstring.func_overload in your PHP configuration. This option is incompatible with phpMyAdmin and might cause breaking of some data!';  //to translate
$strMbExtensionMissing = 'The mbstring PHP extension was not found and you seem to be using multibyte charset. Without mbstring extension phpMyAdmin is unable to split strings correctly and it may result in unexpected results.';  //to translate
$strAfterInsertNext = 'Edit next row';  //to translate
?>
