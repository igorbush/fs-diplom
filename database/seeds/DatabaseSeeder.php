<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('films')->insert([
            'title' => 'Перегонщик',
            'duration' => 100,
            'poster' => 'kompromis.jpg',
            'description' => 'Бывший сотрудник спецподразделения Фрэнк Мартин, известный также как Перевозчик, уходит от дел и поселяется в Майами, где устраивается шофером в богатую семью. С маленьким сыном этого семейства у него завязываются дружеские отношения.',
            'country' => 'США',
        ]);
        DB::table('films')->insert([
            'title' => 'Отряд самоубийц и другие приключения junior-разработчиков',
            'duration' => 120,
            'poster' => 'suicide.jpg',
            'description' => 'Правительство решает дать команде суперзлодеев шанс на искупление. Подвох в том, что их отправляют на выполнение миссии, где они, вероятнее всего, погибнут.',
            'country' => 'США',
        ]);
        DB::table('films')->insert([
            'title' => 'Трэш',
            'duration' => 140,
            'poster' => 'flash.jpg',
            'description' => 'Физик-ядерщик Барри Аллен в ходе неудачного научного эксперимента подвергается серьёзному облучению ядохимикатами. Но, к собственному удивлению, не погибает, а приобретает новые поразительные способности. Благодаря метаморфозам, произошедшим из-за облучения его ДНК, герой теперь способен развивать невообразимую скорость.',
            'country' => 'США',
        ]);
        DB::table('films')->insert([
            'title' => 'Зоопарк Пермского периода',
            'duration' => 90,
            'poster' => 'jurassic.jpg',
            'description' => 'Экспансивный богач и профессор уговаривает двух палеонтологов приехать на остров у побережья Коста-Рики, где он устроил парк Юрского периода. Парк населен давно вымершими динозаврами, воссозданными профессором по образцам крови из ископаемого комара, которые должны стать гвоздем программы нового аттракциона. До открытия остается несколько дней, а один из сотрудников, пытаясь украсть бесценные эмбрионы, нарушает систему охраны, что вместе с грозовым ливнем приводит к отключению электричества и защитных барьеров. Как раз в тот момент, когда палеонтологи с внуками профессора отправились на пробную экскурсию.',
            'country' => 'Пермь',
        ]);
        DB::table('films')->insert([
            'title' => 'Как угробить франшизу 3D',
            'duration' => 150,
            'poster' => 'residentevil.jpg',
            'description' => 'Действия фильма разворачиваются с того момента, на котором закончилась предыдущая часть. После того как Вескер предал Элис в Вашингтоне, конец истории человечества стал еще ближе. Элис — последняя надежда на спасение мира. Она должна вернуться к точке отсчета, туда, где все и началось — город Раккун-Сити, где корпорация «Амбрелла» готовится к финальной атаке по тем, кому удалось выжить.',
            'country' => 'США',
        ]);
        DB::table('films')->insert([
            'title' => 'Если хозяин с тобой!',
            'duration' => 110,
            'poster' => 'poster2.jpg',
            'description' => '20 000 лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу, а жизнь зависела от того, удалось загнать добычу или нет. Молодой охотник из племени, которое по уровню жизни и культуры было одним из самых развитых на планете, оказывается один на один с враждебным миром, полным смертельных опасностей. Ему предстоит взглянуть в лицо своим страхам и найти дорогу домой. И, возможно, от исхода его путешествия зависит судьба всего человечества.',
            'country' => 'Великобритания',
        ]);
        DB::table('halls')->insert([
            'name' => 'аврора',
            'price' => 100,
            'price_vip' => 200,
            'rows' => 7,
            'chairs' => 7,
            'map' => '{"1":{"1":"f","2":"f","3":"s","4":"s","5":"s","6":"f","7":"f"},"2":{"1":"f","2":"f","3":"s","4":"s","5":"s","6":"f","7":"f"},"3":{"1":"f","2":"f","3":"s","4":"s","5":"s","6":"f","7":"f"},"4":{"1":"s","2":"s","3":"v","4":"v","5":"v","6":"s","7":"s"},"5":{"1":"s","2":"s","3":"v","4":"v","5":"v","6":"s","7":"s"},"6":{"1":"s","2":"s","3":"v","4":"v","5":"v","6":"s","7":"s"},"7":{"1":"s","2":"s","3":"v","4":"v","5":"v","6":"s","7":"s"}}',
        ]);
        DB::table('halls')->insert([
            'name' => 'аврора',
            'price' => 90,
            'price_vip' => 190,
            'rows' => 9,
            'chairs' => 9,
            'map' => '{"1":{"1":"f","2":"f","3":"f","4":"s","5":"s","6":"s","7":"f","8":"f","9":"f"},"2":{"1":"f","2":"f","3":"f","4":"s","5":"s","6":"s","7":"f","8":"f","9":"f"},"3":{"1":"f","2":"f","3":"f","4":"s","5":"s","6":"s","7":"f","8":"f","9":"f"},"4":{"1":"s","2":"s","3":"s","4":"s","5":"s","6":"s","7":"s","8":"s","9":"s"},"5":{"1":"s","2":"s","3":"s","4":"s","5":"s","6":"s","7":"s","8":"s","9":"s"},"6":{"1":"s","2":"s","3":"s","4":"v","5":"v","6":"v","7":"s","8":"s","9":"s"},"7":{"1":"s","2":"s","3":"s","4":"v","5":"v","6":"v","7":"s","8":"s","9":"s"},"8":{"1":"s","2":"s","3":"s","4":"v","5":"v","6":"v","7":"s","8":"s","9":"s"},"9":{"1":"s","2":"s","3":"s","4":"v","5":"v","6":"v","7":"s","8":"s","9":"s"}}',
        ]);
        DB::table('seances')->insert([
            'time' => '01:00',
            'film_id' => 5,
            'hall_id' => 2,
        ]);
        DB::table('seances')->insert([
            'time' => '04:00',
            'film_id' => 4,
            'hall_id' => 2,
        ]);
        DB::table('seances')->insert([
            'time' => '01:00',
            'film_id' => 1,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'time' => '05:00',
            'film_id' => 2,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'time' => '10:00',
            'film_id' => 6,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'time' => '20:00',
            'film_id' => 4,
            'hall_id' => 1,
        ]);
        DB::table('seances')->insert([
            'time' => '07:00',
            'film_id' => 6,
            'hall_id' => 2,
        ]);
        DB::table('seances')->insert([
            'time' => '21:00',
            'film_id' => 2,
            'hall_id' => 2,
        ]);
        DB::table('seances')->insert([
            'time' => '10:00',
            'film_id' => 4,
            'hall_id' => 2,
        ]);
        DB::table('seances')->insert([
            'time' => '15:00',
            'film_id' => 3,
            'hall_id' => 2,
        ]);
        DB::table('seances')->insert([
            'time' => '15:00',
            'film_id' => 3,
            'hall_id' => 1,
        ]);
    }
}
