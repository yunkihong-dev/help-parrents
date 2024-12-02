CREATE TABLE tbl_tiniping (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tini_name VARCHAR(10) NOT NULL,
    tini_gen VARCHAR(10) NOT NULL,
    tini_rank VARCHAR(10) NOT NULL,
    tini_description VARCHAR(100) NOT NULL,
    tini_symbol VARCHAR(50) NOT NULL,
    tini_magic VARCHAR(250) NOT NULL,
    tini_img_path varchar(10) NOT NULL,
    tini_traits VARCHAR(300) NOT NULL,
    tini_favorite_food VARCHAR(50) NOT NULL,
    tini_disliked_food VARCHAR(50) NOT NULL,
    tini_item VARCHAR(80) NOT NULL
);



INSERT INTO tbl_tiniping
(tini_name, 
tini_gen,
tini_rank,
tini_description,
tini_symbol, 
tini_magic,
tini_traits, 
tini_favorite_food, 
tini_disliked_food,
tini_item, 
tini_img_path)
VALUES(
'하츄핑', 
'1기', 
'로열티니핑',
'여자',
'하트', 
'① <사랑의 빛>(1기 손거울)[7] 밝은 빛으로 적들을 방해할 수 있다. ② <사랑의 선율>(2기 하프) 하트 모양 음표를 발사하거나, 대상의 진로를 방해하거나, 행동에 제약을 줄 수 있다. ③ <사랑의 향기>(3기 향수) 향수를 뿌려서 상대 공격을 막을 수 있으며, 대상을 향기에 취하게 만들 수 있다. ④ <사랑의 종소리>(4기 핸드벨) 핸드벨에서 딸기 타르트 모양 음표를 발산하여 상대를 교란시킨다. ⑤ <사랑의 퍼프>(5기 글로우 퍼프)',
'캐치! 티니핑 시리즈의 메인 티니핑 및 메인 로열핑으로 로미와 더불어 양대 주인공이자 메인 마스코트 캐릭터. 사랑의 티니핑. 늘 로미와 함께 다니며 애교 넘치는 로열핑으로, 사랑과 배려가 넘치는 성격. 티니핑 중 로미와 가장 친하며, 비밀의 방에 있던 티니핑 봉인이 풀려나 지구로 흩어질 때 로미가 손을 꼭 잡아준 덕분에 유일무이하게 지구로 떨어지지 않고 로미와 함께 처음부터 같이 다녔으며, 모든 티니핑 중 유일무이하게 모든 회차와 시즌에 출연 중이다.', 
'생크림 딸기 케이크, 딸기', 
'신맛이 나는 모든 것', 
'손거울(1기)→ 하프(2기)→ 향수(3기)→ 핸드벨(4기)→ 글로우 퍼프(5기)', 
'하츄핑.png');

INSERT INTO tbl_tiniping
(tini_name, 
tini_gen,
tini_rank,
tini_description,
tini_symbol, 
tini_magic,
tini_traits, 
tini_favorite_food, 
tini_disliked_food,
tini_item, 
tini_img_path)
VALUES(
'바로핑', 
'1기', 
'로열티니핑',
'남자',
'구름', 
'① <올바른 문법> 기호/이모티콘을 만들어 날릴 수 있다. ② 상대가 바른 생활을 하도록 만들 수 있다.',
'캐치! 티니핑의 메인 티니핑 및 서브 로열핑. 시리즈 최초로 등장한 남성 로열 티니핑이다. 올바름의 티니핑. 존댓말 캐릭터이며, 성실한 성격으로 무슨 일이든 올바르게 행한다. 정해진 시간에만 정해진 일을 행해야 하는 스타일.', 
'깔끔하게 정돈된 환경, 독서, 공부, 뭔가를 가르치기', 
'늦잠, 게으름, 무질서한 상태, 더러운 환경', 
'마법책', 
'바로핑.png');

INSERT INTO tbl_tiniping
(tini_name, 
tini_gen,
tini_rank,
tini_description,
tini_symbol, 
tini_magic,
tini_traits, 
tini_favorite_food, 
tini_disliked_food,
tini_item, 
tini_img_path)
VALUES(
'아자핑', 
'1기', 
'로열티니핑',
'남자',
'별', 
'① <용기의 플래시> 상대를 잠시동안 움직이지 못하게 만든다. ② 대상에게 잠시동안 용기를 북돋아줄 수 있다.',
'캐치! 티니핑의 메인 티니핑 및 서브 로열핑. 용기의 티니핑. 겁없고 열혈스러운 성격으로, 생각보다 몸이 먼저 움직이는 다혈질스러운 스타일.', 
'하츄핑, 체력단련, 격투기 및 액션 영화 보기', 
'두려움, 도망치기, 포기하기', 
'카메라', 
'아자핑.png');

INSERT INTO tbl_tiniping
(tini_name, 
tini_gen,
tini_rank,
tini_description,
tini_symbol, 
tini_magic,
tini_traits, 
tini_favorite_food, 
tini_disliked_food,
tini_item, 
tini_img_path)
VALUES(
'차차핑', 
'1기', 
'로열티니',
'여자',
'네잎클로버', 
'① <희망의 물줄기> 물을 뿌려 팅클퍼프 마법을 풀 수 있다. ② 사물/대상의 크기를 키우거나, 시든 식물을 생생하게 만든다.',
'캐치! 티니핑의 메인 티니핑 및 서브 로열핑. 시리즈 최초로 하츄핑을 제외한 로열 티니핑 중에서 등장한 여성 로열 티니핑이다. 희망의 티니핑. 너그럽고 낙관적인 성격으로 물뿌리개를 소품으로 가지고 다닌다.', 
'화초에 물 주기, 식물 보살피기, 꽃 향기 맡기, 격려하기', 
'꽃을 꺾거나 잔디를 밟는 등의 행동, 부정적인 말과 행동', 
'물뿌리개', 
'아자핑.png');

INSERT INTO tbl_tiniping
(tini_name, 
tini_gen,
tini_rank,
tini_description,
tini_symbol, 
tini_magic,
tini_traits, 
tini_favorite_food, 
tini_disliked_food,
tini_item, 
tini_img_path)
VALUES(
'라라핑', 
'1기', 
'로열티니핑',
'여자',
'음표가 붙은 리본', 
'① <즐거운 댄스> 대상이 춤을 추게 만들 수 있다. ② 대상이 잠시동안 무언가를 즐겁게 느끼게 만들 수 있다. ③ 마이크를 사용해, 자신이 아닌 다른 이의 목소리를 낼 수 있다.',
'캐치! 티니핑의 메인 티니핑 및 서브 로열핑. 즐거움의 티니핑. 수다쟁이에 쾌활한 성격의 분위기 메이커지만 그와 대조되게 음치에 박치다. 그리고 머리 묶은 모습이 토끼를 닮았다.', 
'노래와 춤, 신나는 놀이, 수다', 
'심각한 분위기, 지루한 것', 
'마이크', 
'라라핑.png');

INSERT INTO tbl_tiniping
(tini_name, 
tini_gen,
tini_rank,
tini_description,
tini_symbol, 
tini_magic,
tini_traits, 
tini_favorite_food, 
tini_disliked_food,
tini_item, 
tini_img_path)
VALUES(
'해핑', 
'1기', 
'로열티니핑',
'여자',
'태양', 
'① <행복의 방울방울> 비눗방울 안에 대상을 가두거나, 누군가를 태워 이동시킬 수 있다. ② 대상을 잠시동안 행복하게 만들 수 있다.',
'캐치! 티니핑의 메인 티니핑 및 서브 로열핑으로 시리즈 최초의 추가전사 포지션 티니핑이다.행복의 티니핑. 어미는 자신의 이름에서 받침 ㅇ을 뺀 ~해피를 사용한다.', 
'비눗방울 놀이, 낙서하기, 다른 티니핑 행동 따라하기', 
'더 놀고 싶은데 자야 하는 것', 
'비눗방울 장난감', 
'해핑.png');
