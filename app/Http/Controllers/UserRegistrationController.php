<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=UserRegistrationController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DAO\UserDAO;
use App\Entity\User;
use App\Http\Controllers\Controller;

/**
 * 新規登録に関するコントローラークラス
 */

class UserRegistrationController extends Controller{
    /**
     * 新規登録処理
     */
    public function registration(Request $request){
        // 変数のセット 
        $isRedirect = false;
        $templatePath = 'user/top';
        $assign = [];

        // 入力された値の受け取り
        $name = $request->input('name');
        $name2 = $request->input('name2');
        $name = $name . $name2;
        $name_furi = $request->input('name-furi');
        $name_furi2 = $request->input('name-furi2');
        $nameFuri = $name_furi . $name_furi2;
        $gender = $request->input('gender');
        $zip1 = $request->input('zip1');
        $zip2 = $request->input('zip2');
        $post = $zip1 . $zip2;
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $birthday = $request->input('birthday');
        $tel = $request->input('tel');
        $mail = $request->input('mail');
        $password = $request->input('password');
        // パスワードのハッシュ化
        $password = password_hash($password, PASSWORD_DEFAULT);
        // 会員種別が無料会員なので1にする
        $customerFlg = 1;

        // 空白が入っていたら取り除く
        $name = trim($name);
        $nameFuri = trim($nameFuri);
        $post = trim($post);
        $address1 = trim($address1);
        $address2 = trim($address2);
        $tel = trim($tel);
        $mail = trim($mail);
        $password = trim($password);

        // 変数宣言
        $validationMsgs = [];

        // 入力された値とDBに登録するデータをエンティティに格納
        $user = new User();
        $user->setMail($mail);
        $user->setPassword($password);
        $user->setName($name);
        $user->setNameFuri($nameFuri);
        $user->setGender($gender);
        $user->setBirthday($birthday);
        $user->setTel($tel);
        $user->setPost($post);
        $user->setAddress($address1);
        $user->setAddressDetails($address2);
        $user->setCustomerFlg($customerFlg);


        // DB接続
        $db = DB::connection()->getPdo();
        $userDAO = new UserDAO($db);

        // 入力されたメールアドレスが存在するかチェック
        $userCheck = $userDAO->findByMail($mail);
        if(!($userCheck == null)){
            $validationMsgs[] =  '既に登録されているメールアドレスです。別のメールアドレスを使用してください。';
        }

        // エラーがなければDB登録
        if(empty($validationMsgs)){
            // DBに登録
            $userId = $userDAO->userInsert($user);
            if($userId === -1){
                $validationMsgs[] = '情報登録に失敗しました。もう一度初めからやり直してください。';
            }
            else{
                $isRedirect = true;
            }
        }
        // エラーがなければポータルページに遷移する
        if($isRedirect){
            $response = redirect('/goPortal');
        }
        // エラーがあれば入力値とエラーメッセージを保持し登録画面に戻る
        else{
            if(!empty($validationMsgs)){
                $assign['RegistrationMalidationMsgs'] = $validationMsgs;
                $assign['name1'] = $name;
                $assign['name2'] = $name2;
                $assign['name_furi1'] = $name_furi;
                $assign['name_furi2'] = $name_furi2;
                $assign['zip1'] = $zip1;
                $assign['zip2'] = $zip2;
                $assign['user'] = $user;
            }
            $response = view($templatePath,$assign);
        }
        return $response;
    }

}
