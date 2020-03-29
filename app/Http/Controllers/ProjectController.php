<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectGroup;
use App\ProjectGroupCampaign;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    const FILTER = -1;

    /**
     * List of all projects
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->has('project_activity')) {
            $validated = $request->validate([
                'project_activity' => 'required|int',
            ]);
        } else {
            $validated['project_activity'] = self::FILTER;
        }

        if($validated['project_activity'] != self::FILTER) {
            $projects = Project
                ::join('project_groups', 'projects.id', '=', 'project_groups.project_id')
                ->join('project_group_campaigns', 'project_groups.id', '=', 'project_group_campaigns.project_group_id')
                ->select('projects.id AS projectId', 'projects.name AS projectName', 'projects.website AS projectWebsite', 'projects.active AS projectActive', 'project_groups.name AS groupName', 'project_group_campaigns.name AS campaignName')
                ->where('projects.active', $validated['project_activity'])
                ->orderBy('projectId', 'DESC')
                ->paginate(40)
                ->appends('project_activity', $validated['project_activity']);
        } else {
            $projects = Project
                ::join('project_groups', 'projects.id', '=', 'project_groups.project_id')
                ->join('project_group_campaigns', 'project_groups.id', '=', 'project_group_campaigns.project_group_id')
                ->select('projects.id AS projectId', 'projects.name AS projectName', 'projects.website AS projectWebsite', 'projects.active AS projectActive', 'project_groups.name AS groupName', 'project_group_campaigns.name AS campaignName')
                ->orderBy('projectId', 'DESC')
                ->paginate(40);
        }

        return view('/crud/index', [
            'projects' => $projects,
            'project_activity' => $validated['project_activity']
        ]);
    }

    /**
     * Add a new project(view)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('/crud/create');
    }

    /**
     * Add a new project
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_name' => 'required|max:191',
                'project_website' => 'required|max:191',
                'project_activity' => 'required|int',
                'group_name' => 'required|max:191',
                'group_budget' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'campaign_name' => 'required|max:191',
                'campaign_status' => 'required|int',
                'campaign_start_date' => 'required|date',
            ]);

            $project = new Project();
            $project->name = $validated['project_name'];
            $project->website = $validated['project_website'];
            $project->active = $validated['project_activity'];
            $project->save();

            $group = new ProjectGroup();
            $group->project_id = $project->id;
            $group->name = $validated['group_name'];
            $group->budget = $validated['group_budget'];
            $group->save();

            $campaign = new ProjectGroupCampaign();
            $campaign->project_group_id = $group->id;
            $campaign->name = $validated['campaign_name'];
            $campaign->status = $validated['campaign_status'];
            $campaign->date_start = $validated['campaign_start_date'];
            $campaign->save();

            return redirect()->route('crudList')->with('success','Dodano nowy projekt');
        } catch (Exception $e) {
            return redirect()->route('crudList')->with('error','Podczas dodawania projektu wystąpił błąd!');
        }
    }

    /**
     * Display project
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $project = Project
            ::join('project_groups', 'projects.id', '=', 'project_groups.project_id')
            ->join('project_group_campaigns', 'project_groups.id', '=', 'project_group_campaigns.project_group_id')
            ->select('projects.id AS projectId', 'projects.name AS projectName', 'projects.website AS projectWebsite', 'projects.active AS projectActive', 'project_groups.name AS groupName', 'project_group_campaigns.name AS campaignName', 'project_group_campaigns.date_start AS campaignDate')
            ->findOrFail($id);

        return view('/crud/show', compact('project'));
    }

    /**
     * Edit project(view)
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $project = Project
            ::join('project_groups', 'projects.id', '=', 'project_groups.project_id')
            ->join('project_group_campaigns', 'project_groups.id', '=', 'project_group_campaigns.project_group_id')
            ->select('projects.id AS projectId', 'projects.name AS projectName', 'projects.website AS projectWebsite', 'projects.active AS projectActive', 'project_groups.name AS groupName', 'project_group_campaigns.name AS campaignName', 'project_group_campaigns.date_start AS campaignDate')
            ->findOrFail($id);

        return view('/crud/edit', compact('project'));
    }

    /**
     * Update project
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'project_name' => 'required|max:191',
                'project_website' => 'required|max:191',
                'project_activity' => 'required|int',
                'group_name' => 'required|max:191',
                'campaign_name' => 'required|max:191',
                'campaign_start_date' => 'required|date',
            ]);

            $project = Project::whereId($id)->first();
            $project->name = $validated['project_name'];
            $project->website = $validated['project_website'];
            $project->active = $validated['project_activity'];
            $project->save();

            $group = ProjectGroup::where('project_id', $id)->first();
            $group->name = $validated['group_name'];
            $group->save();

            $campaign = ProjectGroupCampaign::where('project_group_id', $group->id)->first();
            $campaign->name = $validated['campaign_name'];
            $campaign->date_start = $validated['campaign_start_date'];
            $campaign->save();

            return redirect()->route('crudEdit', $id)->with('success','Zedytowano projekt');
        } catch (Exception $e) {
            return redirect()->route('crudEdit', $id)->with('error','Podczas edycji projektu wystąpił błąd!');
        }
    }

    /**
     * Delete project
     *
     * @param $projectId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $projetGroup = ProjectGroup::where('project_id', $id)->first();

            $projetGroup->delete();
            $project->delete();

            return redirect()->route('crudList')->with('success', 'Projekt został usunięty');
        } catch (Exception $e) {
            return redirect()->route('crudList')->with('error', 'Podczas usuwania wystąpił błąd!');
        }
    }
}
