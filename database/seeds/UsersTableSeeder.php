<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://img2.imgtn.bdimg.com/it/u=2240829538,1689099562&fm=26&gp=0.jpg',
            'http://img3.imgtn.bdimg.com/it/u=399974178,4035113539&fm=11&gp=0.jpg',
            'http://img1.imgtn.bdimg.com/it/u=3251029328,2490819195&fm=26&gp=0.jpg',
            'http://img2.imgtn.bdimg.com/it/u=3340466117,2726682841&fm=26&gp=0.jpg',
            'http://img2.imgtn.bdimg.com/it/u=2289198615,2271927219&fm=26&gp=0.jpg',
            'http://img0.imgtn.bdimg.com/it/u=3293099503,606929711&fm=26&gp=0.jpg',
            'http://img0.imgtn.bdimg.com/it/u=1499786340,3160605610&fm=26&gp=0.jpg',
            'http://img0.imgtn.bdimg.com/it/u=363561487,3458647895&fm=26&gp=0.jpg',
            'http://img0.imgtn.bdimg.com/it/u=2862042311,2684682653&fm=26&gp=0.jpg',
            'http://img1.imgtn.bdimg.com/it/u=314677669,3594175002&fm=26&gp=0.jpg',
        ];

        // 生成数据集合
        $users = factory(User::class)
                    ->times(10)
                    ->make()
                    ->each(function ($user, $index)
                            use ($faker, $avatars)
                            {
                                $user->avatar = $faker->randomElement($avatars);
                            });
        
        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户数据
        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->avatar = 'http://img5.imgtn.bdimg.com/it/u=3140397485,1984669600&fm=26&gp=0.jpg';
        $user->save();
    }
}
