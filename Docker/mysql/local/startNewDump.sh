docker_id=$(docker ps -aqf "name=^thedb$")
docker exec -it $docker_id sh "./getnewDump.sh"

