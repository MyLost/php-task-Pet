<?php

namespace App\Controller;

use App\Entity\PetEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PetController extends AbstractController
{

    public function createAction(Request $request)
    {

        if ($request->getMethod() === "OPTIONS") {
            return new Response('', Response::HTTP_OK, $this->getHeaders());
        }

        if (($request->headers->get('content-type')) === "application/json") {
            $data = $request->toArray();
            $animalName = $data['name'];
            $animalBreed = $data['breed'];
            $animalDescription = $data['description'];

            $entityManager = $this->getDoctrine()->getManager();

            $pet = new PetEntity();
            $pet->setName($animalName);
            $pet->setBreed($animalBreed);
            $pet->setDescription($animalDescription);
            $pet->setRecordDate(new \DateTime());

            $entityManager->persist($pet);
            $entityManager->flush();

            return $this->json(["status" => "created"],
                Response::HTTP_OK, $this->getHeaders());
        } else {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
            $response->setContent(json_encode(["status" => "not_created"]));
            $response->headers->set('Content-Type', 'application/json');
            return $response->send();
        }

    }

    public function searchAction(Request $request)
    {

        if ($request->getMethod() === "OPTIONS") {
            return new Response('', Response::HTTP_OK, $this->getHeaders());
        }

        $criteria = [];
        if ($request->query->get('name') && $request->query->get('name') !== "") {
            $criteria['name'] = $request->query->get('name');
        }
        if ($request->query->get('breed') && $request->query->get('breed') !== "") {
            $criteria['breed'] = $request->query->get('breed');
        }
        if ($request->query->get('name') === "" && $request->query->get('breed') === "") {
            return new Response(json_encode(['status' => 'not_found']), Response::HTTP_OK, $this->getHeaders());
        }
        $results = $this->getDoctrine()->getRepository(PetEntity::class)->findBy($criteria);

        $body = [];

        foreach ($results as $result) {
            array_push($body, ["name" => $result->getName(),
                "breed" => $result->getBreed(),
                "description" => $result->getDescription(),
                "recordDate" => $result->getRecordDate()
            ]);
        }

        if (empty($body)) {
            return new Response(json_encode(['status' => 'not_found']), Response::HTTP_OK, $this->getHeaders());
        }

        return new Response(json_encode($body), Response::HTTP_OK, $this->getHeaders());
    }


    private function getHeaders()
    {
        return [
            'Content-Type' => '*',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS',
            'Accept' => '*',
        ];
    }
}