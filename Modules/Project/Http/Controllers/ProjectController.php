<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Project\Contracts\ProjectServiceContract;
use Modules\Project\Entities\Project;
use Modules\Project\Http\Requests\ProjectRequest;
use Modules\Project\Entities\ProjectContract;

class ProjectController extends Controller
{
    protected $service;

    public function __construct(ProjectServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->service->index(request()->all());

        return view('project::index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = $this->service->getClients();

        return view('project::create')->with('clients', $clients);
    }

    /**
     * Store a newly created resource in storage.
     * @param ProjectRequest $request
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        $this->service->store($validated);

        return redirect(route('project.index'))->with('success', 'Project has been created successfully!');
    }

    /**
     * Show the specified resource.
     * @param Project $project
     */
    public function show(Project $project)
    {
        $contract = ProjectContract::where('project_id', $project->id)->first();
        $contractFilePath = $contract ? storage_path('app/' . $contract->contract_file_path) : null;

        return view('project::show', [
            'project' => $project,
            'contract' => $contract,
            'contractFilePath' => $contractFilePath,
        ]);
    }

    public static function showPdf(ProjectContract $contract)
    {
        $filePath = storage_path('app/' . $contract->contract_file_path);
        $content = file_get_contents($filePath);
        $contractFileName = pathinfo($contract->contract_file_path)['filename'];

        return response($content)->withHeaders([
            'content-type' => mime_content_type($filePath),
            'contractFileName' => $contractFileName
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Project $project
     */
    public function edit(Project $project)
    {
        return view('project::edit', [
            'project' => $project,
            'clients' => Client::all(),
            'teamMembers' => $this->service->getTeamMembers(),
            'projectTeamMembers' => $this->service->getProjectTeamMembers($project),
            'projectRepositories' => $this->service->getProjectRepositories($project),
            'designations' => $this->service->getDesignations(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param ProjectRequest $request
     */
    public function update(ProjectRequest $request, Project $project)
    {
        return $this->service->updateProjectData($request->all(), $project);
    }
}
