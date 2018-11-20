AddEventHandler('rconCommand', function(commandName, args)
    if commandName == 'FiveMessage' then 
        TriggerClientEvent('chatMessage', -1, "[SINISTER RP]", {0, 0, 0}, " " .. args[1])
    end
end)
