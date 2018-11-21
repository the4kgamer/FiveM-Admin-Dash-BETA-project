
function banuser(id)
	
	--make sql connection




AddEventHandler('rconCommand', function(commandName, args)
	if commandName == 'oKAOSKDW881982' then
		for k,v in ipairs(GetPlayerIdentifiers(id))do

			--get players name to insert into DB
			local player = GetPlayerName(player)
			--illiminate connection
			DropPlayer(id, GetConvar("ban_reason", "you were banned from this server"))
			--put them into banned database
			MySQl.Async.execute("INSERT INTO banned (player) VALUES (@player)", { ['player'] = player})
			--look for ban details from what was put in PHP website
			MySQL.Async.fetchAll("SELECT * FROM logs WHERE player = '"..player.."'", { ['@player'] = player, ['@admin'] = admin, ['@reason'] = reason}, function (result)
				--admin and reason are both forign names from the table that is being fetched, admin = $_SESSION, reason = $_POST in PHP.
		    TriggerClientEvent('chatMessage', source, "SYSTEM", {255, 0, 0}, .. GetPlayerName(player) .. "has been banned by" ..admin.. "for"..reason.."--Script Made By The4kGamer")
		end
		
	end

end)

--defines getting player name

function getPlayerID(source)
	local identifiers = GetPlayerIdentifiers(source)
	local player = getIdentifiant(identifiers)
	return player 
end)