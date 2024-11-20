# Laravel DSpace 7 client

This is a Laravel Dspace7 client to manage dublin core metadata between platforms. 

## Installation
You can install this plugin using composer
~~~
composer require epsomsegura/laraveldspaceclient
~~~

## Seting up Laravel environment
You should add this variables with your DSpace 7 administration information into ***.env*** file
~~~
# DSpace admin email
DSPACE_API_EMAIL="admin@email.com"
# Dspace admin password
DSPACE_API_PASS="mystrongpassword"
# DSpace API URL base
DSPACE_API_URL="https://mydomain.com/server/api/"
# DSpace API domain
DSPACE_API_DOMAIN="mydomain.com"
~~~
This variables makes plugin can connect to DSpace 7 backend and make requests to its API.

___

This is an example using plugin
~~~
<?php
...
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateBitstreamByItemUuidController;
...

class SomeClass{

    public function someMethod(){
        // REQUIRED REPOSITORY NAME
        /*
        * THIS IS A REQUIRED METADATA TO SEND TO DSPACE
        */
        $item = [
            "name" => $repository->name,
            "metadata" => [],
            "inArchive" => true,
            "discoverable" => true,
            "withdrawn" => false,
            "type" => "item"
        ];

        /*
        * GET MY OWN METADATA LIST FROM MY CODE/DATABASE TO SEND TO DSPACE
        * IT´S IMPORTANT TO HAVE THE SAME METADATA SETTED INTO DSPACE METADATA!
        */
        $metadataValues = $repository->metadataValues()->with('metadata')->get();
        
        /*
        * ITERATE TO FILL MY METADATA ARRAY TO SEND TO DSPACE
        */
        foreach ($metadataValues as $metadataValue) {
            $item["metadata"][$metadataValue->metadata->name][] = [
                "value" => $metadataValue->value,
                "language" => null,
                "authority" => null,
                "confidence" => -1,
                "place" => 0
            ];
        }
    
        //REQUIRED REPOSITORY NAME
        /*
        * THIS IS A REQUIRED METADATA TO SEND TO DSPACE
        */
        $item["metadata"]["dc.type"][] = [
            "value" => "Recurso Educativo Abierto",
            "language" => null,
            "authority" => null,
            "confidence" => -1,
            "place" => 0
        ];

        /*
        * TRY/CATCH TO SAVE ITEM INTO DSPACE
        */
        $collectionName = $request->collectionName;
        try {
            /*
            * GETTING HANDLE AFTER CREATE ITEM INTO DSPACE
            */
            $newItem = (new CreateItemController)->handler($item, $collectionName)->toArray();
            $repository->dspace_uuid = $newItem['uuid'];
            $repository->url_identification = $newItem['metadata']['dc.identifier.uri'][0]['value'];
            $repository->save();

            /*
            * IN THIS SPECIFIC CASE WE ADD SOME BEATSTREAMS (FILES) TO OUR ITEM
            * YOU CAN USE THIS CODE TO SEND FILES TO DSPACE IF YOU WANT IT
            */
            $exeLearningFile = $repository->files()->wherePivot('type', 'exelearning')->first();
            $filestream = Storage::get(str_replace('app/', '', $exeLearningFile->path));
            $contentType = Storage::mimeType(str_replace('app/', '', $exeLearningFile->path));
            $file = (new CreateBitstreamByItemUuidController)->handler($filestream, $exeLearningFile->name, $contentType, $repository->dspace_uuid, 'ORIGINAL');
            $webFile = $repository->files()->wherePivot('type', 'web')->first();
            $filestream = Storage::get(str_replace('app/', '', $webFile->path));
            $contentType = Storage::mimeType(str_replace('app/', '', $webFile->path));
            $file = (new CreateBitstreamByItemUuidController)->handler($filestream, $webFile->name, $contentType, $repository->dspace_uuid, 'ORIGINAL');
            $scormFile = $repository->files()->wherePivot('type', 'scorm')->first();
            $filestream = Storage::get(str_replace('app/', '', $scormFile->path));
            $contentType = Storage::mimeType(str_replace('app/', '', $scormFile->path));
            $file = (new CreateBitstreamByItemUuidController)->handler($filestream, $scormFile->name, $contentType, $repository->dspace_uuid, 'ORIGINAL');

            Alert::success('¡Envío completo!', "El ítem ha sido enviado correctamente al repositorio ecoBUAP.");
            return redirect()->back();
        } catch (Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
}

~~~

<small>
Authors: 

**Epsom Segura**:  [[Website](https://epsomsegura.com)]  |  [[LinkedIn](https://www.linkedin.com/in/epsomsegura)]  |  [[Facebook](https://www.facebook.com/EpsomSegura/)]   |  [[YouTube](https://www.youtube.com/@epsomsegura)] 

**eScire**: [[Website](https://www.escire.lat)]  |  [[LinkedIn](https://www.linkedin.com/company/escire/mycompany/)]  |  [[Facebook](https://www.facebook.com/esciremx)]  |  [[YouTube](https://www.youtube.com/@escire6223)]
</small>