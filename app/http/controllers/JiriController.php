<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use Core\Exceptions\FileNotFoundException;
use Core\Response;

class JiriController
{
    private Jiri $jiri;

    public function __construct()
    {
        try {
            $this->jiri = new Jiri(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            die($exception->getMessage());
        }
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        $sql_upcoming_jiris = <<<SQL
                SELECT * FROM jiris 
                         WHERE name LIKE :search  
                               AND starting_at > current_timestamp
                SQL;
        $statement_upcoming_jiris =
            $this->jiri->prepare($sql_upcoming_jiris);
        $statement_upcoming_jiris->bindValue(':search', "%{$search}%");
        $statement_upcoming_jiris->execute();
        $upcoming_jiris =
            $statement_upcoming_jiris->fetchAll();

        $sql_passed_jiris = <<<SQL
                SELECT * FROM jiris 
                         WHERE name LIKE :search
                             AND starting_at < current_timestamp
                SQL;
        $statement_passed_jiris =
            $this->jiri->prepare($sql_passed_jiris);
        $statement_passed_jiris->bindValue(':search', "%{$search}%");
        $statement_passed_jiris->execute();
        $passed_jiris =
            $statement_passed_jiris->fetchAll();

        view('jiris.index', compact('upcoming_jiris', 'passed_jiris'));
    }

    public function create(): void
    {
        view('jiris.create');
    }

    public function store(): void
    {
        //Validation
        if (!isset($_POST['name'], $_POST['starting_at'])) {
            Response::abort(Response::BAD_REQUEST);
        }
        // Tester la qualité des données

        //Save in database
        $insert_jiri_in_jiris_table_sql = 'INSERT INTO jiris (name, starting_at) VALUES (:name, :starting_at)';
        $insert_jiri_in_jiris_table_stmt = $this->jiri->prepare($insert_jiri_in_jiris_table_sql);
        $success = $insert_jiri_in_jiris_table_stmt->execute([
            'name' => $_POST['name'],
            'starting_at' => $_POST['starting_at'],
        ]);
        if ($success) {
            Response::redirect('/jiris');
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function show(): void
    {
        //Récupérer l'id
        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }
        $id = $_GET['id'];

        $jiri = $this->jiri->findOrFail($id);

        view('jiris.show', compact('jiri'));
    }

    public function destroy():void
    {
        //Récupérer l'id
        if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }
        $id = $_POST['id'];

        $this->jiri->delete($id);

        Response::redirect('/jiris');
    }
}