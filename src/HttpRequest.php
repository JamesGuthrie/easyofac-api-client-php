<?php

namespace EasyOfac\Api;

use EasyOfac\Api\Exceptions\ApiException;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Stream;

class HttpRequest
{
	static $_guzzle = NULL;

	public static function send($client, $endpoint, $options = [])
	{
		$guzzle = self::$_guzzle;
		
		if(!isset($guzzle))
		{
			$guzzle = self::$_guzzle = new GuzzleHttpClient();
		}
		
		$options = array_merge(
			[
				'method'      => 'GET',
				'body'  => null,
				'query' => null
			],
			$options
		);
			
	
		$headers = array_merge([
			'User-Agent'   => $client->getUserAgent()
		], $client->getHeaders());
				
		if(! empty($options['file']))
		{
			$stream = Stream::factory($options['file']);
			$options['save_to'] = $stream;
			unset($options['file']);
		}
		
		if (! empty($options['body'])) 
		{
			$options['body'] = $options['body'];
		}
		
		if(isset($options["headers"]))
		{
			$options["headers"] = array_merge($headers, $options["headers"]);
		}
		else
		{
			$options["headers"] = $headers;
		}
		
		$method = $options['method'];
		unset($options['method']);
		
        $request = $guzzle->createRequest(
			$method, 
			$client->getApiUrl() . $endpoint,
			$options
		);
		
		try 
		{
            $response = $guzzle->send($request);
        } 
		catch (RequestException $e) 
		{	
			$response = $e->getResponse();
			switch($response->getStatusCode()) 
			{
				case 400:
					$data = json_decode($response->getBody()->getContents(), true);
					throw new ApiException($data['message'], $data['messages']);
					break;
				case 401:
					throw new ApiException("Could not be authenticated.  Please check your credentials!");
					break;
				case 404:
					throw new ApiException("Requested resoruce could not be found.");
					break;
				default:
					throw new ApiException("Unknown Error Occurred.  Please try again or contact technical support!");
					break;
			}
			
		}
		
		return json_decode($response->getBody()->getContents());
	}
	
}