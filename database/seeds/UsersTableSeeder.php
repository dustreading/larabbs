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
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpinjnh0j306j06xq5r.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpinrczvj306v06s76q.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpinxwgqj3079065jt7.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpio6gsdj307206y40x.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpiob02wj307e06sjtd.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpiog2wyj307l07ljtr.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpiolmqoj306i05utam.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpiopsyzj306b05tmyv.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpiovmonj307706zzmv.jpg',
            'http://tva1.sinaimg.cn/large/007X8olVly1g8cpip1qgfj307b06ymzo.jpg',
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
        $user->avatar = 'http://tva1.sinaimg.cn/large/007X8olVly1g8cpip885pj307d079jtf.jpg';
        $user->save();
    }
}
