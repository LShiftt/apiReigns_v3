<?php

declare(strict_types=1); // strict mode

namespace App\Controller;

use App\Model\Alea;

class AleaController extends Controller
{
    public function getAll()
    {
        $res = Alea::getInstance()->findAll();
        Controller::json($res);
    }

    public function getByNum()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $num = (int) $data['id'];

        $criterias = [
            'num_carte' => $num
        ];

        $res = Alea::getInstance()->findOneBy($criterias);
        Controller::json($res);
    }
    public function getByIdCreateurAndIdDeck()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $idCrea = (int) $data['idCrea'];
        $idDeck = (int) $data['idDeck'];

        $criterias = [
            'id_createur' => $idCrea,
            'id_deck' => $idDeck
        ];

        $res = Alea::getInstance()->findOneBy($criterias);
        Controller::json($res);
    }

    public function add()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $num = (int) $data['num'];
        $idDeck = (int) $data['idDeck'];
        $idCrea = (int) $data['idCrea'];

        $infos = [
            'num_carte' => $num,
            'id_deck' => $idDeck,
            'id_createur' => $idCrea
        ];

        Alea::getInstance()->create($infos);
    }

    public function delete(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        Alea::getInstance()->del($id);
    }
}
