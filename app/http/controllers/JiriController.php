<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use Core\Concerns\Request\HasIdentifier;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class JiriController
{
    private Jiri $jiri;

    use HasIdentifier;

    public function __construct()
    {
        try {
            $this->jiri = new Jiri(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            exit($exception->getMessage());
        }
    }

    #[NoReturn]
    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        $sql_upcoming_jiris = <<<'SQL'
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

        $sql_passed_jiris = <<<'SQL'
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

    #[NoReturn]
    public function store(): void
    {
        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
        ]);

        if ($this->jiri->create($data)) {
            Response::redirect('/jiris');
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function create(): void
    {
        view('jiris.create');
    }

    public function show(): void
    {
        $id = $this->checkValidId();

        $jiri = $this->jiri->findOrFail($id);

        view('jiris.show', compact('jiri'));
    }

    public function edit(): void
    {
        $id = $this->checkValidId();

        $jiri = $this->jiri->findOrFail($id);

        view('jiris.edit', compact('jiri'));
    }

    #[NoReturn]
    public function update(): void
    {
        $id = $this->checkValidId();

        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
        ]);

        $this->jiri->update($id, $data);

        Response::redirect('/jiri?id='.$id);
    }

    #[NoReturn]
    public function destroy(): void
    {
        $id = $this->checkValidId();

        $this->jiri->delete($id);

        Response::redirect('/jiris');
    }
}
