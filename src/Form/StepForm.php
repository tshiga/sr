<?php
/**
 * Created by IntelliJ IDEA.
 * User: HiroYamaguchi
 * Date: 2017/10/19
 * Time: 8:11
 */

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;



class StepForm extends Form
{
    var $labels = array(
        'has_license'=>'どの資格をお持ちですか？',
        'work_style'=>'働き方',
        'term_wish'=>'希望時期',
        'zip_code'=>'郵便番号',
        'address_prefecture'=>'都道府県',
        'address_city'=>'市区町村',
        'name'=>'お名前',
        'birthday_year'=>'生年月：年',
        'birthday_month'=>'生年月：月',
        'tel'=>'電話番号',
        'email'=>'メールアドレス',
    );

    protected function _buildSchema(Schema $schema)
    {
        return $schema
            //Step1
            ->addField('has_license', [ 'type' => 'string', ])

            //Step2
            ->addField('work_style', [ 'type' => 'string'])->addField('term_wish', [  'type' => 'string'])

            //Step3
            ->addField('zip_code', [ 'type' => 'string', ])
            ->addField('address_prefecture', [ 'type' => 'string', ])
            ->addField('address_city', [ 'type' => 'string', ])

            //Step4
            ->addField('name', [ 'type' => 'string', ])
            ->addField('birthday_year', [ 'type' => 'string', ])
            ->addField('birthday_month', [ 'type' => 'string', ])

            //Step5
            ->addField('tel', [ 'type' => 'string', ])
            ->addField('email', [ 'type' => 'string', ])
            ;
    }

    protected function _buildValidator(Validator $validator)
    {

        //Step1
        $validator->notBlank('has_license', '入力してください')
            -> minLength('has_license', 1,'1文字以上の入力が必要です')
            -> maxLength('has_license', 64,'64文字以下の入力が必要です')
            /*-> add('has_license', 'selection', ['rule' =>
                    function ($value, $context) {
                        return (bool) preg_match('/^(看護師|准看護師|保健師|その他|助産師)$/', $value);
                    },
                    'message' => '入力が一致しません' ]
            )*/
            ;



        //Step2
        $validator->notBlank('work_style', '入力してください')
            -> minLength('work_style', 1,'1文字以上の入力が必要です')
            -> maxLength('work_style', 64,'64文字以下の入力が必要です')
            /*-> add('work_style', 'selection', ['rule' =>
                    function ($value, $context) {
                        return (bool) preg_match('/^(常勤（日勤のみ）|派遣|その他)$/', $value);
                    },
                    'message' => '入力が一致しません' ]
            )*/
            ->allowEmpty('term_wish')
            -> minLength('term_wish', 1,'1文字以上の入力が必要です')
            -> maxLength('term_wish', 64,'64文字以下の入力が必要です')
            /*-> add('term_wish', 'selection', ['rule' =>
                    function ($value, $context) {
                        return (bool) preg_match('/^(1か月以内|2か月以内|3か月以内|6か月以内)$/', $value);
                    },
                    'message' => '入力が一致しません' ]
            )*/
            ;


        //Step3
        $validator->notBlank('address_prefecture', '入力してください')
            -> minLength('address_prefecture', 1,'1文字以上の入力が必要です')
            -> maxLength('address_prefecture', 64,'64文字以下の入力が必要です')
            -> add('address_prefecture', 'selection', ['rule' =>
                    function ($value, $context) {
                        return (bool) preg_match('/^(北海道|青森県|岩手県|宮城県|秋田県|山形県|福島県|茨城県|栃木県|群馬県|埼玉県|千葉県|東京都|神奈川県|新潟県|富山県|石川県|福井県|山梨県|長野県|岐阜県|静岡県|愛知県|三重県|滋賀県|京都府|大阪府|兵庫県|奈良県|和歌山県|鳥取県|島根県|岡山県|広島県|山口県|徳島県|香川県|愛媛県|高知県|福岡県|佐賀県|長崎県|熊本県|大分県|宮崎県|鹿児島県|沖縄県)$/', $value);
                    },
                    'message' => '入力が一致しません' ]
            )

            ->notBlank('address_city', '入力してください')
            -> minLength('address_city', 1,'1文字以上の入力が必要です')
            -> maxLength('address_city', 64,'64文字以下の入力が必要です')

            ->allowEmpty('zip_code')
            ->numeric('zip_code','数字のみ入力してください')
            -> minLength('zip_code', 5,'1文字以上の入力が必要です')
            -> maxLength('zip_code', 7,'255文字以下の入力が必要です')

        ;


        //Step4
        $validator->notBlank('name', '入力してください')
            -> minLength('name', 1,'1文字以上の入力が必要です')
            -> maxLength('name', 64,'64文字以下の入力が必要です')
            -> add('name', 'selection', ['rule' =>
                    function ($value, $context) {
                        return (bool) preg_match('/^[ぁ-んァ-ヶー一-龠０１２３４５６７８９]+$/u', $value);
                    },
                    'message' => 'カタカナ・ひらがな・漢字のみ入力可能です' ]
            )

            ->notBlank('birthday_year', '入力してください')
            ->numeric('birthday_year','数字のみ入力してください')
            -> minLength('birthday_year', 4,'4文字以上の入力が必要です')
            -> maxLength('birthday_year', 4,'4文字以下の入力が必要です')

            ->notBlank('birthday_month', '入力してください')
            ->numeric('birthday_month','数字のみ入力してください')
            -> minLength('birthday_month', 1,'1文字以上の入力が必要です')
            -> maxLength('birthday_month', 2,'2文字以下の入力が必要です')

        ;

        //Step5
        $validator->notBlank('tel', '入力してください')
            -> minLength('tel', 10,'10文字以上の入力が必要です')
            -> maxLength('tel', 13,'13文字以下の入力が必要です')
            -> add('tel', 'selection', ['rule' =>
                    function ($value, $context) {
                        return (bool) preg_match('/^[0-9-]+$/', $value);
                    },
                    'message' => '数字およびハイフンのみ入力可能です' ]
            )

            ////->notBlank('email', '入力してください')
            ->allowEmpty('email')
            ->email('email', false,'メールアドレス形式になっている必要があります')

        ;

        return $validator;
    }

    public function getFields(){
        $schema = $this->schema();
        //var_dump($schema);
        return $schema->fields();
    }

}
