<?php

/*
namespace App\Http\controllers;

use App\Models\Contact;
use App\models\Project;
use App\Models\ProjectContact;
use Core\Auth;
use Core\Concerns\Request\HasIdentifier;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class ProjectController
{
    private Project $project;
    private Contact $contact;
    private ProjectContact $project_contact;

    use HasIdentifier;

    public function __construct()
    {
        try {
            $this->project = new Project();
            $this->contact = new Contact();
            $this->project_contact = new ProjectContact();
        } catch (FileNotFoundException $e) {
            exit($e->getMessage());
        }
    }

    public function index(): void
    {
        $passed_projects = $this->project->getPastProjects(Auth::id(), 'user');
        $upcoming_projects = $this->project->getUpcomingProjects(Auth::id(), 'user');
        $current_projects = $this->project->getCurrentProjects(Auth::id(), 'user');

        view('projects.index', compact('passed_projects', 'upcoming_projects', 'current_projects'));
    }

    public function show(): void
    {
        $id = $this->checkValidID();

        $project = $this->project->findOrFail($id);

        $this->check_ownership($project);

        $project = $this->project->fetchProject($id);

        $contacts = $this->project->fetchContacts($id);

        view('projects.show', compact('project', 'contacts'));
    }

    public function create(): void
    {
        $contacts = $this->contact->belongingTo(Auth::id(), 'user');
        view('projects.create', compact('contacts'));
    }

    #[NoReturn] public function store(): void
    {

        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
            'ending_at' => 'required|datetime',
            'description' => 'required|min:3|max:500',
        ]);

        $data['user_id'] = Auth::id();

        $filtered_data = array_filter($data, fn($key) => $key !== 'contacts' && !str_starts_with($key, 'role-'));

        if ($this->project->create($filtered_data)) {
            $project_id = $this->project->lastInsertId();
            if (isset($_REQUEST['contacts'])) {
                foreach ($_REQUEST['contacts'] as $contact_id) {
                    $role = $_REQUEST['role-' . $contact_id];
                    $this->project_contact->create(compact('project_id', 'role', 'contact_id'));
                }
            }
            Response::redirect('/project?id=' . $project_id);
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function edit(): void
    {
        $id = $this->checkValidID();
        $project = $this->project->findOrFail($id);
        $this->check_ownership($project);

        view('projects.edit', compact('project'));
    }

    #[NoReturn] public function update(): void
    {
        $id = $this->checkValidID();

        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
            'ending_at' => 'required|datetime',
            'description' => 'required|min:3|max:500',
        ]);

        $this->check_ownership($id);

        $this->project->update($id, $data);

        Response::redirect('/project?id=' . $id);
    }

    #[NoReturn] public function destroy(): void
    {
        $id = $this->checkValidId();

        $this->check_ownership($id);

        $this->project_contact->deleteFormOthersTables($id, 'project');

        $this->project->delete($id);

        Response::redirect('/projects');
    }

    public function check_ownership(int|string|stdClass $project): void
    {
        if (is_numeric($project)) {
            $project = $this->project->findOrFail($project);
        }

        if (Auth::id() !== $project?->user_id) {
            Response::abort(Response::UNAUTHORIZED);
        }
    }
}
*/

namespace App\Http\controllers;

use App\Models\Contact;
use App\models\Project;
use App\Models\ProjectContact;
use Core\Auth;
use Core\Concerns\Request\HasIdentifier;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class ProjectController
{
    private Project $project;
    private ProjectContact $project_contact;
    private Contact $contact;

    use HasIdentifier;

    public function __construct()
    {
        try {
            $this->project = new Project();
            $this->project_contact = new ProjectContact();
            $this->contact = new Contact();
        } catch (FileNotFoundException $e) {
            exit($e->getMessage());
        }
    }

    public function index(): void
    {
        $passed_projects = $this->project->getPassedProjects(Auth::id(), 'user');
        $upcoming_projects = $this->project->getUpcomingProjects(Auth::id(), 'user');
        $current_projects = $this->project->getCurrentProjects(Auth::id(), 'user');

        view('projects.index', compact('passed_projects', 'upcoming_projects', 'current_projects'));
    }

    public function show(): void
    {
       $id = $this->checkValidId();
       $project = $this->project->findOrFail($id);
       $this->check_ownership($project);

       $contacts = $this->project->fetchContacts($id, Auth::id(), 'project', 'user');

       view('projects.show', compact('project', 'contacts'));
    }

    #[NoReturn] public function destroy(): void
    {
        $id = $this->checkValidId();
        $this->check_ownership($id);

        $this->project_contact->deleteFromOthersTables($id, 'project');

        $this->project->delete($id);

        Response::redirect('/projects');
    }

    public function create():void
    {
        $contacts = $this->contact->belongingTo(Auth::id(), 'user');

        view('projects.create', compact('contacts'));
    }

    #[NoReturn] public function store(): void
    {
        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
            'ending_at' => 'required|datetime',
            'description' => 'required|min:3|max:500',
        ]);

        $data['user_id'] = Auth::id();

        $filtered_data = array_filter($data, fn($key) => $key !== 'contacts' && !str_starts_with($key, 'role-'), ARRAY_FILTER_USE_KEY);

        if ($this->project->create($filtered_data)) {
            $project_id = $this->project->lastInsertId();
            if (isset($_REQUEST['contacts'])) {
                foreach ($_REQUEST['contacts'] as $contact_id) {
                    $role = $_REQUEST['role-'.$contact_id];
                    $this->project_contact->create(compact('project_id', 'role', 'contact_id'));
                }
            }
            Response::redirect('/project?id='.$project_id);
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    private function check_ownership(int|string|stdClass $project): void
    {
        if (is_numeric($project)) {
            $project = $this->project->findOrFail($project);
        }

        if (Auth::id() !== $project?->user_id) {
            Response::abort(Response::UNAUTHORIZED);
        }
    }
}