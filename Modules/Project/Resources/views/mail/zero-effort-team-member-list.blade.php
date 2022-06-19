<div>
    @php
        @dd($projectManager);
    @endphp
    @php  $projectManagerName = implode(', ', $projectManager['projectManagerName']); @endphp
    <p>Hello {{ $projectManagerName }},</p>
    <p>We found some projects where the expected hours are zero for you or team members where you are assigned as project manager. Please update these projects:</p>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ProjectName</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projectManager['projects'] as $projects)
            <tr>
                @foreach ($projects as $project )
                    <td>{{ $project->name }}</td>
                @endforeach
            </tr>
             @endforeach
        </tbody>
      </table>
</div>