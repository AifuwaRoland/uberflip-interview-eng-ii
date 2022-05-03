<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link href="favicon.ico" rel="icon" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Uberflip Technical Challenge</title>
    </head>
    <body>
        <script src="/js/app.js"></script>
        <div class="container mx-auto p-4">
            <img class="w-16 h-16 mr-4 float-left" src="uberflip.png" alt="Logo" />
            <h1 class="text-4x1 text-indigo font-bold py-10 text-center">{{ $title ?? 'University Domain List' }}</h1>


            <table class="table table-bordered">
                <thead style="background:#e02b67">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">State/Province</th>
                        <th scope="col">Country</th>
                        <th scope="col">Alpha-2-Code</th>
                        <th scope="col">Domains</th>
                        <th scope="col">Web Pages</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr><td colspan="6">{{ $universities->links() }}</td></tr>
                </tfoot>
                <tbody>
                <!-- set university with more than 1 domain to blue -->
                @foreach($universities as $university)
                    <tr scope="row"
                    @if(count($university->domains) > 1)
                        style="background:#91c1ff"  
                    @endif
                    >
                        <td>{{ $university['name'] }}</td>
                        <td>{{ $university['state-province'] }}</td>
                        <td>{{ $university['country'] }}</td>
                        <td>{{ $university['alpha_two_code'] }}</td>
                        <td>
                            @foreach($university->domains as $domain)
                                {{ $domain['domain_name'] }}<br/>
                            @endforeach
                        </td>
                        <td>
                            @foreach($university->webpages as $webpage)
                                <a href="{{ $webpage['url'] }}">{{ $webpage['url'] }}</a><br/>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </body>
</html>